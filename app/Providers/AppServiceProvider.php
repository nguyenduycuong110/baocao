<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\Auth\AuthWebServiceInterface;
use App\Services\Impl\Auth\AuthService;
use App\Services\Interfaces\User\UserCatalogueServiceInterface;
use App\Services\Impl\User\UserCatalogueService;
use App\Services\Interfaces\User\UserServiceInterface;
use App\Services\Impl\User\UserService;
use App\Services\Interfaces\Permission\PermissionServiceInterface;
use App\Services\Impl\Permission\PermissionService;
use App\Services\Interfaces\Area\ProvinceServiceInterface;
use App\Services\Impl\Area\ProvinceService;
use App\Services\Interfaces\Area\DistrictServiceInterface;
use App\Services\Impl\Area\DistrictService;
use App\Services\Interfaces\Team\TeamServiceInterface;
use App\Services\Impl\Team\TeamService;
use App\Services\Interfaces\Vehicle\VehicleServiceInterface;
use App\Services\Impl\Vehicle\VehicleService;
use App\Services\Interfaces\Passenger\PassengerServiceInterface;
use App\Services\Impl\Passenger\PassengerService;
use App\Services\Interfaces\Cargo\CargoServiceInterface;
use App\Services\Impl\Cargo\CargoService;
use App\Services\Interfaces\Risk\RiskServiceInterface;
use App\Services\Impl\Risk\RiskService;
use App\Services\Interfaces\Tax\TaxServiceInterface;
use App\Services\Impl\Tax\TaxService;
use App\Services\Interfaces\Consultation\ConsultationServiceInterface;
use App\Services\Impl\Consultation\ConsultationService;
use App\Services\Interfaces\Check\CheckServiceInterface;
use App\Services\Impl\Check\CheckService;
use App\Services\Interfaces\Digital\DigitalServiceInterface;
use App\Services\Impl\Digital\DigitalService;
use App\Services\Interfaces\Other\OtherServiceInterface;
use App\Services\Impl\Other\OtherService;
use App\Services\Interfaces\Merchandise\MerchandiseServiceInterface;
use App\Services\Impl\Merchandise\MerchandiseService;
use App\Services\Interfaces\Unit\UnitServiceInterface;
use App\Services\Impl\Unit\UnitService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthWebServiceInterface::class, AuthService::class);
        $this->app->bind(UserCatalogueServiceInterface::class, UserCatalogueService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);
        $this->app->bind(ProvinceServiceInterface::class, ProvinceService::class);
        $this->app->bind(DistrictServiceInterface::class, DistrictService::class);
        $this->app->bind(TeamServiceInterface::class, TeamService::class);
        $this->app->bind(VehicleServiceInterface::class, VehicleService::class);
        $this->app->bind(PassengerServiceInterface::class, PassengerService::class);
        $this->app->bind(CargoServiceInterface::class, CargoService::class);
        $this->app->bind(RiskServiceInterface::class, RiskService::class);
        $this->app->bind(TaxServiceInterface::class, TaxService::class);
        $this->app->bind(ConsultationServiceInterface::class, ConsultationService::class);
        $this->app->bind(CheckServiceInterface::class, CheckService::class);
        $this->app->bind(DigitalServiceInterface::class, DigitalService::class);
        $this->app->bind(OtherServiceInterface::class, OtherService::class);
        $this->app->bind(MerchandiseServiceInterface::class, MerchandiseService::class);
        $this->app->bind(UnitServiceInterface::class, UnitService::class);
    }

    public function boot(): void
    {
        
    }
}
