<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/
//frontEnd Controller List
Route::get('/','FrontEndController@index')->name('index');

Route::get('/pages/{value}', 'FrontEndController@otherPages');

Route::prefix('/product')->group(function(){
    Route::get('all-products','FrontEndController@allProducts')->name('all.products');
    Route::get('category/{id}','FrontEndController@categoryProducts')->name('category.products');
    Route::get('/single/{id}','FrontEndController@singelProduct')->name('product');
    Route::get('/feature','FrontEndController@featureProducts')->name('feature.products');
    Route::get('/giftType/{id}','FrontEndController@giftTypeIdProducts')->name('giftType.products');
    Route::get('/gift','FrontEndController@allGiftProducts')->name('gift.products');
    Route::get('/favorite/{id}/{action}', 'FrontEndController@productFavourite')->name('favorite');

    Route::get('category/shop/{categoryId}/{shopId}','FrontEndController@categoryByShopProducts')->name('category.shop.products');
    Route::get('category/size/{categoryId}/{size}','FrontEndController@categoryBySizeProducts')->name('category.size.products');

    //Singel Product Reviews Controller list
    Route::post('/reviews/comment', 'ProductReviewsController@productsReviewsCommentStore')->name('reviews.comment');
    Route::post('question','ConsumerQuestionController@consumerQuestionStore')->name('consumer.question');
});

//produnct Shopping Route List
Route::prefix('shopping')->group( function(){
    Route::get('/cart', 'ShoppingController@cartShow')->name('cart.show');
    Route::post('/cart/add', 'ShoppingController@addToCart')->name('cart.add');
    Route::post('/cart/update', 'ShoppingController@cartUpdate')->name('cart.update');
    Route::get('/cart/remove/{id}', 'ShoppingController@deleteCartProduct')->name('cart.remove');
    Route::get('/checkout', 'ShoppingController@checkout')->name('checkout');
    Route::get('/shipping', 'ShoppingController@shippingInfo')->name('shipping');
    Route::get('district/{divId}', 'AjexRequestController@districtList');
    Route::get('area/{divId}/{disId}', 'AjexRequestController@areaList');
    Route::post('/shipping', 'ShoppingController@saveShippingInfo')->name('shipping.save');
    Route::get('/payment', 'ShoppingController@payment')->name('payment');
    Route::post('/payment', 'ShoppingController@paymentStore')->name('payment.save');
    Route::get('/order', 'ShoppingController@storeOrderInfo')->name('order.store');
    Route::post('/payment-status/{status}', 'ShoppingController@paymentVerify')->name('payment_verify');

});

Route::get('/shop/view/{id}', 'FrontEndController@viewShop')->name('shop.view');
Route::get('/shop/favourite/{id}/{action}', 'FrontEndController@shopFavourite')->name('shop.favourite');
Route::post('dorpon/search', 'SearchController@search')->name('search');


Route::prefix('page')->group( function(){
    Route::get('about/{page}', 'FrontEndController@aboutDorpon')->name('about');
    Route::get('help-center/{page}', 'FrontEndController@helpCenter')->name('helpCenter');
});
//User Panel Controller List
Auth::routes();
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('social-login');
Route::get('subcribe/{provider}', 'Auth\LoginController@redirectToProvider')->name('social-subcribe');
Route::post('subcribe', 'Auth\LoginController@storeSubcriber')->name('subcribe');

Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::prefix('consumer')->group( function(){
    Route::post('/sign-in', 'Auth\LoginController@consumerSignIn')->name('user.signIn');
    Route::post('/sign-up','Auth\RegisterController@signUp')->name('user.signUp');
    Route::get('sign-up/confirmation/{token}','Auth\RegisterController@signUpconfirmation')->name('signUp.confirmation');
    Route::get('register/confirmation/{token}','Auth\RegisterController@registerConfirmation')->name('register.confirmation');
    Route::get('/home', 'HomeController@index')->name('user.home');
    Route::get('/logout', 'Auth\LoginController@userlogout')->name('user.logout');

    Route::get('/detail/edit/form', 'HomeController@detailsEditFrom')->name('deatil.edit.form');
    Route::get('/detail/edit/district/{divId}', 'AjexRequestController@districtList');
    Route::get('/detail/edit/area/{divId}/{disId}', 'AjexRequestController@areaList');
    Route::post('/detail/update', 'HomeController@detailsCreateOrUpdate')->name('deatils.add');
    Route::get('profile-image/change', 'HomeController@profileImageChnage')->name('profile.image');
    Route::post('profile-image/change', 'HomeController@profileImageUpdate');
});


//Merchantile Panel Controller List
Route::prefix('merchantile')->group( function(){
    //Auth/MerchantileRegisterController
    Route::get('register', 'Auth\MerchantileRegisterController@showRegistrationForm')->name('shop.register');
    Route::post('register', 'Auth\MerchantileRegisterController@shopRegister');
    Route::get('shop/confirmation/{token}', 'Auth\MerchantileRegisterController@confirmation')->name('shop.confirmation');
    Route::get('confirmation/{token}', 'Auth\ShopModaratorController@modaratorConfirmation')->name('modarator.confirmation');
    // Password Reset Routes...
    Route::get('password/reset', 'Auth\MerchantileForgotPasswordController@showLinkRequestForm')->name('merchantile.password.request');
    Route::post('password/email', 'Auth\MerchantileForgotPasswordController@sendResetLinkEmail')->name('merchantile.password.email');
    Route::get('password/reset/{token}', 'Auth\MerchantileResetPasswordController@showResetForm')->name('merchantile.password.reset');
    Route::post('password/reset', 'Auth\MerchantileResetPasswordController@reset');
    //Auth/MerchantileLogin Conroller
    Route::get('/login', 'Auth\MerchantileLoginController@showLoginForm')->name('merchantile.login');
    Route::post('/login', 'Auth\MerchantileLoginController@login');

    Route::get('/check', 'MerchantileController@confarmationCheck')->name('merchantile.confarmation.check');
    Route::get('/dashboard', 'MerchantileController@index')->name('merchantile.dashboard');
    Route::get('logout', 'Auth\MerchantileLoginController@logout')->name('merchantile.logout');

});

Route::group(['middleware'=>['auth:merchantile']], function(){

    Route::prefix('shop')->group( function(){


        Route::prefix('artisan')->group( function(){
            Route::get('/profile-image', 'MerchantileController@artisanProfileimage')->name('artisan.profile.image');
            Route::post('/change-image', 'MerchantileController@artisanProfileImageChange')->name('profile.image.change');
            Route::get('/change-password-form', 'MerchantileController@artisanPasswordChangeForm')->name('password.change.form');
            Route::post('/change-password', 'MerchantileController@artisanChangePassword')->name('artisan.password.change');
        });


        Route::prefix('item')->group( function(){
            Route::get('view','ProductController@shopProductView')->name('items');
            Route::get('insert', 'ProductController@shopInsert')->name('item.insert');
            Route::post('store', 'ProductController@store')->name('item.store');
            Route::get('singel/show/{id}', 'ProductController@singelShow')->name('singel.item');
            Route::get('edit/{id}', 'ProductController@shopProductEdit')->name('item.edit')->where(['id' => '[0-9]+']);
            Route::post('update', 'ProductController@update')->name('item.update');
            Route::get('delete/{id}', 'ProductController@destroy')->name('item.delete');
            Route::get('image/delete/{id}', 'ProductController@singelImageDelete')->name('item.image.delete');

            //when request for product Store form
            Route::get('ajex/subcat/{cat_id}','AjexRequestController@secondCategoryFind');
            Route::get('ajex/thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');
            route::get('tag/store/{title}/{value}','AjexRequestController@tagStore')->name('tag.store');
            route::get('priColor/store/{colorName}/{colorCode}','AjexRequestController@primaryColorsStore');
            route::get('secColor/store/{colorName}/{colorCode}','AjexRequestController@secondaryColorsStore');

            route::get('mianCatSize/{mainCatId}','AjexRequestController@mianCategorySize');
            route::get('secCatSize/{secCatId}','AjexRequestController@secCategorySize');
            route::get('thirdCatSize/{thirdCatId}','AjexRequestController@thirdCategorySize');

            route::get('priceCount','AjexRequestController@productPriceCount');


            //when request from product Updata form
            Route::prefix('edit')->group( function(){
                Route::get('/ajex/subcat/{cat_id}','AjexRequestController@secondCategoryFind');
                Route::get('ajex/thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');
                route::get('tag/store/{title}/{value}','AjexRequestController@tagStore')->name('tag.store');
                route::get('priColor/store/{colorName}/{colorCode}','AjexRequestController@primaryColorsStore');
                route::get('secColor/store/{colorName}/{colorCode}','AjexRequestController@secondaryColorsStore');

                route::get('priceCount','AjexRequestController@productPriceCount');
                route::get('/shopFind/edit','AjexRequestController@shopFind');
                route::get('/suplierFind','AjexRequestController@suplierFind');

                route::get('mianCatSize/{mainCatId}','AjexRequestController@mianCategorySize');
                route::get('secCatSize/{secCatId}','AjexRequestController@secCategorySize');
                route::get('thirdCatSize/{thirdCatId}','AjexRequestController@thirdCategorySize');
            });
        });

        Route::prefix('order')->group( function(){
            Route::get('/', 'OrderController@shopViewOrders')->name('shop.orders');
            Route::get('/singel/{orderId}', 'OrderController@shopSingelOrderView')->name('shop.singel.order');
            Route::get('/shipping/{orderId}', 'OrderController@shippingOrder')->name('shop.shipping.order');
            Route::get('invoice/download/{oderId}/{type}', 'InvoiceController@shopPdfInvoiceDownload')->name('shop.invoice');
        });



        Route::prefix('profile')->group( function(){
            Route::get('/', 'ShopDetailsController@index')->name('shop.profile');
            Route::post('shop-address', 'ShopDetailsController@updateShopAddress')->name('update.shopAddress');
            Route::post('about-shop', 'ShopDetailsController@updateAboutShop')->name('update.aboutShop');
            Route::post('retutn-policy', 'ShopDetailsController@updateReturnPolicy')->name('update.returnPolicy');
            Route::post('shipping-policy', 'ShopDetailsController@updateSippingPolicy')->name('update.sippingPolicy');

            Route::post('shop-name-change', 'ShopDetailsController@shopNameChange')->name('shop.name.change');
            Route::post('shop-email-change', 'ShopDetailsController@shopEmailChange')->name('shop.email.change');
            Route::post('artisan-view-name', 'ShopDetailsController@artisanViewName')->name('artisan.view.name');
            Route::post('shop-website-change', 'ShopDetailsController@shopWebsiteChange')->name('shop.website.change');

            Route::post('logo-change', 'ShopDetailsController@shoplogoChange')->name('logo.change');
            Route::post('coverImage-change', 'ShopDetailsController@shopCoverImageChange')->name('coverImage.change');
            Route::get('district/{divId}', 'AjexRequestController@districtList');
            Route::get('area/{divId}/{disId}', 'AjexRequestController@areaList');
        });


        Route::prefix('modarator')->group( function(){
            Route::post('store','Auth\ShopModaratorController@store')->name('modarator.store');
            Route::post('delate','Auth\ShopModaratorController@delate')->name('modarator.delate');
            
        });

        Route::Post('delete/request', 'MerchantileController@shopDeleteRequest')->name('shop.delete.request');



    });

});


//Admin Panel Controller List

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showloginform')->name('admin.login');
    Route::post('/login/submit', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/home', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::group(['middleware'=>['auth:admin']], function(){

    Route::prefix('admin')->group( function(){

        Route::get('/register','Auth\AdminRegisterController@showRegisterForm')->name('admin.register.form');
        Route::post('/register','Auth\AdminRegisterController@adminRegister')->name('admin.register');
        Route::get('/account-setting','Auth\AdminRegisterController@accountSetting')->name('account.setting');
        Route::post('/account-setting','Auth\AdminRegisterController@accountSettingUpdate')->name('account.setting');
        Route::post('/change-password','Auth\AdminRegisterController@changePassword')->name('change.password');
        Route::get('/delete/{id}','Auth\AdminRegisterController@adminDelete')->name('admin.delete');

        Route::prefix('read/notification')->group(function(){
            Route::get('new-shop/{notifitionId}', 'AdminController@newShopNotification')->name('new.shop.Notify');
            Route::get('new-product/{notifitionId}', 'AdminController@newProductNotification')->name('new.product.Notify');
        });
        

        Route::prefix('category')->group( function(){
            Route::get('show', 'CategoryController@index')->name('category');
            Route::post('store', 'CategoryController@store')->name('category.store');
            Route::get('edit/{id}', 'CategoryController@edit')->name('category.edit');
            Route::post('update', 'CategoryController@update')->name('category.update');
            Route::post('delete', 'CategoryController@destroy')->name('category.delete');

            Route::get('maincat','AjexRequestController@mianCategorySearch');
            Route::get('subcat/{cat_id}','AjexRequestController@secondCategoryFind');
        });

        Route::prefix('giftType')->group( function(){
            Route::get('show', 'GiftTypeController@index')->name('giftType');
            Route::post('store', 'GiftTypeController@store')->name('giftType.store');
            Route::post('update', 'GiftTypeController@update')->name('giftType.update');
            Route::post('delete', 'GiftTypeController@destroy')->name('giftType.delete');
        });

        Route::prefix('size')->group( function(){
            Route::get('view', 'SizeColtroller@view')->name('sizes');
            Route::get('insert', 'SizeColtroller@insert')->name('size.insert');
            Route::get('copy/{id}', 'SizeColtroller@copy')->name('size.copy');
            Route::get('edit/{id}', 'SizeColtroller@edit')->name('size.edit');
            Route::post('store', 'SizeColtroller@store')->name('size.store');
            Route::Post('update', 'SizeColtroller@update')->name('size.update');
            Route::get('delete', 'SizeColtroller@destroy')->name('size.delete');

            Route::get('subcat/{cat_id}','AjexRequestController@secondCategoryFind');
            Route::get('thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');
            
            Route::get('edit/subcat/{cat_id}','AjexRequestController@secondCategoryFind');
            Route::get('edit/thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');

            Route::get('copy/subcat/{cat_id}','AjexRequestController@secondCategoryFind');
            Route::get('copy/thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');
        });

        Route::prefix('material')->group( function(){
            Route::get('view', 'ProductMaterialController@view')->name('materials');
            Route::get('store/{name}/{des}', 'ProductMaterialController@store')->name('material.store');
            Route::get('update/{id}/{name}/{des}', 'ProductMaterialController@update')->name('material.update');
            Route::get('delete/{id}', 'ProductMaterialController@destroy')->name('material.delete');
        });

        Route::prefix('color')->group( function(){
            Route::get('view', 'ProductColorController@view')->name('colors');
            Route::get('store/{name}/{code}/{type}', 'ProductColorController@store')->name('color.store');
            Route::get('update/{id}/{name}/{code}/{type}', 'ProductColorController@update')->name('color.update');
            Route::get('delete/{id}/{type}', 'ProductColorController@destroy')->name('color.delete');
        });

        Route::prefix('transport')->group( function(){

            Route::prefix('location')->group( function(){
                Route::get('view', 'TransportController@locationView')->name('locations');
                Route::get('district/{divId}', 'AjexRequestController@districtList');
                Route::get('division', 'TransportController@divisionList');
                Route::post('store', 'TransportController@locationStore')->name('location.store');
                Route::post('update', 'TransportController@locationUpdate')->name('location.update');

            });
            Route::prefix('criteria')->group( function(){
                Route::get('delivery/view', 'TransportController@deliveryView')->name('deliveryCriterias');
                Route::get('pickUp/view', 'TransportController@pickUpView')->name('pickUpCriterias');
                Route::post('store', 'TransportController@transportStore')->name('transport.store');
                Route::post('update', 'TransportController@transportUpdate')->name('transport.update');
                Route::post('delete', 'TransportController@transportDestroy')->name('transport.delete');

            });

        });

        Route::prefix('order')->group( function(){
            Route::get('/', 'OrderController@viewOrders')->name('orders');
            Route::get('singel/{id}', 'OrderController@singelOrderView')->name('singel.order');
            Route::get('/shipping/mail/{id}', 'OrderController@shippingConfirmMail')->name('order.shipping.mail');
            Route::get('invoice/download/{oderId}/{type}', 'InvoiceController@pdfInvoiceDownload')->name('invoice.download');

        });

        Route::prefix('shop')->group(function(){
            Route::get('view/list', 'AccountHolderInfoController@shopList')->name('shop.list');
            Route::get('singel/view/{shopId}', 'AccountHolderInfoController@shopSingelView')->name('shop.singel.view')->where(['id' => '[0-9]+']);
            Route::post('block', 'AccountHolderInfoController@shopBlock')->name('shop.block');

            Route::prefix('singel/view')->group( function(){
                Route::get('asso/{assoId}/{shopId}', 'AjexRequestController@shopAssoChanege');
                Route::get('shop-zone', 'AjexRequestController@shopZoneChanege');
                Route::get('persent/{persent}/{shopId}', 'AjexRequestController@dorponPersentChanege');
                Route::get('quality/{value}/{shopId}', 'AjexRequestController@shopQualityChange');
                Route::get('pickUp/{value}/{shopId}', 'AjexRequestController@shopPickUpChange');
                Route::get('publication/{value}/{shopId}', 'AjexRequestController@shopPublicationChange');
                Route::get('featureShop/{value}/{shopId}', 'AjexRequestController@featureShopStatus');
                Route::get('featureArtisan/{value}/{shopId}', 'AjexRequestController@featureArtisanStatus');
            });


        });

        Route::prefix('user')->group(function(){
            Route::get('view/list', 'AccountHolderInfoController@userList')->name('user.list');
            Route::get('singel/view/{userId}', 'AccountHolderInfoController@userSingelView')->name('user.singel.view');
        });

        Route::prefix('question')->group( function(){
            Route::get('/', 'ConsumerQuestionController@qusenList')->name('qusen.list');
            Route::get('/read/{quesnId}', 'ConsumerQuestionController@readQusen')->name('read.qusen');
            Route::post('/answer', 'ConsumerQuestionController@answerQusen')->name('ans.qusen');
        });


        Route::prefix('product')->group( function(){
            Route::get('/', 'ProductController@adminProductsView')->name('products');
            Route::get('/insert', 'ProductController@adminInsert')->name('product.insert');
            Route::post('/store', 'ProductController@store')->name('product.store');
            Route::get('/singel/show/{id}', 'ProductController@singelShow')->name('singel.product');
            Route::get('/edit/{id}', 'ProductController@adminProductEdit')->name('product.edit');
            Route::post('/update', 'ProductController@update')->name('product.update');
            Route::get('/delete/{id}', 'ProductController@destroy')->name('product.delete');
            Route::get('image/delete/{id}', 'ProductController@singelImageDelete')->name('product.image.delete');
            Route::get('status/{id}/{value}','ProductController@productStatusChange')->name('status.change');


            //when request for product Store form
            Route::get('ajex/subcat/{cat_id}','AjexRequestController@secondCategoryFind');
            Route::get('ajex/thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');
            route::get('tag/store/{title}/{value}','AjexRequestController@tagStore')->name('tag.store');
            route::get('priColor/store/{colorName}/{colorCode}','AjexRequestController@primaryColorsStore');
            route::get('secColor/store/{colorName}/{colorCode}','AjexRequestController@secondaryColorsStore');

            route::get('priceCount','AjexRequestController@productPriceCount');
            route::get('shopFind','AjexRequestController@shopFind');
            route::get('suplierFind','AjexRequestController@suplierFind');


            route::get('mianCatSize/{mainCatId}','AjexRequestController@mianCategorySize');
            route::get('secCatSize/{secCatId}','AjexRequestController@secCategorySize');
            route::get('thirdCatSize/{thirdCatId}','AjexRequestController@thirdCategorySize');

            //when request from product Updata form
            Route::prefix('edit')->group( function(){
                Route::get('/ajex/subcat/{cat_id}','AjexRequestController@secondCategoryFind');
                Route::get('ajex/thirdcat/{mainCatId}/{secCatId}','AjexRequestController@thirdCategoryFind');
                route::get('tag/store/{title}/{value}','AjexRequestController@tagStore')->name('tag.store');
                route::get('priColor/store/{colorName}/{colorCode}','AjexRequestController@primaryColorsStore');
                route::get('secColor/store/{colorName}/{colorCode}','AjexRequestController@secondaryColorsStore');

                route::get('priceCount','AjexRequestController@productPriceCount');
                route::get('/shopFind/edit','AjexRequestController@shopFind');
                route::get('/suplierFind','AjexRequestController@suplierFind');

                route::get('mianCatSize/{mainCatId}','AjexRequestController@mianCategorySize');
                route::get('secCatSize/{secCatId}','AjexRequestController@secCategorySize');
                route::get('thirdCatSize/{thirdCatId}','AjexRequestController@thirdCategorySize');
            });

        });



        Route::prefix('logo')->group( function(){
            Route::get('/', 'TempleteController@viewLogos')->name('logos');
            Route::post('store', 'TempleteController@storeLogo')->name('logo.store');
            Route::post('update', 'TempleteController@updateLogo')->name('logo.update');
            Route::post('delete', 'TempleteController@deleteLogo')->name('logo.delete');
        });

        Route::prefix('slider')->group( function(){
            Route::get('/', 'TempleteController@viewSliders')->name('sliders');
            Route::post('store', 'TempleteController@storeSlider')->name('slider.store');
            Route::post('update', 'TempleteController@updateSlider')->name('slider.update');
            Route::post('delete', 'TempleteController@deleteSlider')->name('slider.delete');
        });

        Route::prefix('video')->group( function(){
            Route::get('/', 'TempleteController@viewVideos')->name('videos');
            Route::post('store', 'TempleteController@storeVideo')->name('video.store');
            Route::post('update', 'TempleteController@updateVideo')->name('video.update');
            Route::post('delete', 'TempleteController@deleteVideo')->name('video.delete');
        });

        Route::prefix('question')->group( function(){
            Route::get('/show','ConsumerQuestionController@showQuestion')->name('show.question');
            Route::get('/reply/{id}','ConsumerQuestionController@replyQuestion')->name('reply.question');
            Route::post('/send','ConsumerQuestionController@storeAnswerAndMail')->name('send.answer');
            Route::get('/delete/{id}','ConsumerQuestionController@deleteQuestion')->name('delete.question');
        });

        Route::prefix('helper')->group( function(){

            Route::prefix('associate')->group( function(){
                Route::get('view', 'DorponAssociateController@view')->name('associates');
                Route::get('district/{divId}', 'DorponAssociateController@districtList');
                Route::get('division', 'DorponAssociateController@divisionList');
                Route::post('store', 'DorponAssociateController@locationStore');
                Route::post('update', 'DorponAssociateController@locationUpdate');

            });
            Route::prefix('friend')->group( function(){
                Route::get('view', 'DorponFriend@deliveryView')->name('friends');
                Route::post('store', 'DorponFriend@transportStore');
                Route::post('update', 'DorponFriend@transportUpdate');
                Route::post('delete', 'DorponFriend@transportDestroy');

            });
            Route::prefix('suppler')->group( function(){
                Route::get('view', 'DorponSupplyer@deliveryView')->name('suppliers');
                Route::post('store', 'DorponSupplyer@transportStore');
                Route::post('update', 'DorponSupplyer@transportUpdate');
                Route::post('delete', 'DorponSupplyer@transportDestroy');

            });

        });



    });


});



