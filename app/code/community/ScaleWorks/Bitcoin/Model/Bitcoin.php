<?php


class ScaleWorks_Bitcoin_Model_Bitcoin extends Varien_Object
{
    private $_client;
    protected $_debug = false;
    protected $_store;

    protected function getServiceUrl() {
        $protocol = Mage::getStoreConfig('payment/bitcoin/bitcoind_https', $this->getStore())? 'https':'http';
        $username = Mage::getStoreConfig('payment/bitcoin/bitcoind_username', $this->getStore());
        $password = Mage::getStoreConfig('payment/bitcoin/bitcoind_password', $this->getStore());
        $host = Mage::getStoreConfig('payment/bitcoin/bitcoind_host', $this->getStore());
        $port = Mage::getStoreConfig('payment/bitcoin/bitcoind_port', $this->getStore());
        $url = $protocol.'://'.$username.':'.$password.'@'.$host.':'.$port.'/';
        return $url;
    }

    protected function getClient() {
        if(!$this->_client) {
            $this->_client = new Jsonrpcphp_Client($this->getServiceUrl(), $this->getDebug());
        }
        return $this->_client;
    }

    public function getStore(){
        // todo: implement.
        return false;
    }

    public function setStore($store) {
        $this->_store = $store;
    }

    public function getDebug() {
        return $this->_debug;
    }

    public function getInfo() {
        return $this->getClient()->getinfo();
    }

}