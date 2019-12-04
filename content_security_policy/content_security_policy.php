<?php
    class ContentSecurityPolicy extends Modules {
        private $nonce;

        public function runtime() {
            $this->nonce = !module_enabled("cacher") ?
                random(32) :
                Modules::$instances["cacher"]->cache_id() ;

            $this->nonce = base64_encode($this->nonce);

            header("Content-Security-Policy:".
                   " default-src 'self';".
                   " style-src 'self' 'unsafe-inline';".
                   " script-src 'self' 'nonce-".$this->nonce."';".
                   " frame-ancestors 'self'");
        }

        public function javascripts_nonce($nonce) {
            return $this->nonce;
        }
    }
