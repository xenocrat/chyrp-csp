<?php
    class ContentSecurityPolicy extends Modules {
        private $nonce;

        public function runtime(): void {
            $this->nonce = base64_encode(random(32));

            header("Content-Security-Policy:".
                   " default-src 'self';".
                   " style-src 'self' 'nonce-".$this->nonce."';".
                   " script-src 'self' 'nonce-".$this->nonce."';".
                   " frame-ancestors 'self';".
                   " form-action 'self';");
        }

        public function javascripts_nonce($nonce): string {
            return $this->nonce;
        }

        public function stylesheets_nonce($nonce): string {
            return $this->nonce;
        }
    }
