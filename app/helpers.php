<?php

use App\Models\CompanyInformation;

if (!function_exists('get_logo_url')) {
    function get_logo_url()
    {
        // Gunakan static variable agar kueri tidak berulang dalam satu request
        static $logoUrl = null;

        if ($logoUrl === null) {
            $companyInfo = CompanyInformation::select('company_logo')->first();

            if ($companyInfo && $companyInfo->company_logo) {
                $logoUrl = asset('storage/' . $companyInfo->company_logo);
            } else {
                $logoUrl = asset('storage/company_logothumb/default-logo.png');
            }
        }

        return $logoUrl;
    }

    function get_logo_header_url()
    {
        // Gunakan static variable agar kueri tidak berulang dalam satu request
        static $headerIconUrl = null;

        if ($headerIconUrl === null) {
            $companyInfo = CompanyInformation::select('company_header')->first();

            if ($companyInfo && $companyInfo->company_header) {
                $headerIconUrl = asset('storage/' . $companyInfo->company_header);
            } else {
                $headerIconUrl = asset('image/default-logo.png');
            }
        }

        return $headerIconUrl;
    }

    function getYoutubeUrl()
    {
        // Gunakan static variable agar kueri tidak berulang dalam satu request
        static $youtubeLink = null;

        if ($youtubeLink === null) {
            $companyInfo = CompanyInformation::select('youtube_link_index')->first();

            $youtubeLink = $companyInfo ? $companyInfo->youtube_link_index : null;
        }

        return $youtubeLink;
    }

    function getFooterUser()
    {
        // Gunakan static variable agar kueri tidak berulang dalam satu request
        static $logoUrl = null;

        $companyInfo = null;
        if ($logoUrl === null) {
            $companyInfo = CompanyInformation::first();

            if ($companyInfo && $companyInfo->company_logo) {
                $logoUrl = asset('storage/' . $companyInfo->company_logo);
            } else {
                $logoUrl = asset('image/default-logo.png');
            }
        }


        $data = [
            'logoUrl' => $logoUrl,
            'company' => $companyInfo
        ];
        return $data;
    }

}

