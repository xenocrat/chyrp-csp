<?php
    class ContentSecurityPolicy extends Modules {
        private $nonce;

        public function runtime() {
            $this->nonce = module_enabled("cacher") ?
                token(array(USE_ZLIB,
                            HTTP_ACCEPT_DEFLATE,
                            HTTP_ACCEPT_GZIP,
                            session_id(),
                            rawurldecode(unfix(self_url())))) : random(32) ;

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
