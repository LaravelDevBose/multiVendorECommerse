@extends('frontEnd.master')

@section('title')
    Dorpon | Help Center
@endsection

@section('headasset')
    <link href="{{asset('public/frontEnd/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{ asset('public/frontEnd/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontEnd/css/helpCenter.css')}}">
    <!--<link href="{{asset('public/frontEnd/css/homepage.css')}}" rel="stylesheet">-->
    <link href="{{asset('public/frontEnd/css/header.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontEnd/css/footer.css')}}" rel="stylesheet">
    

@endsection

@section('content')
<div class="container help-top-cont">
    <div class="help-top">
        <h1>Help Center</h1>
        <div class="helpsearch-container">
            <form action="">
                <input type="text" placeholder="Search Help" name="search">
                <button type="submit">Go</button>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <ul id="help-center" class="nav nav-tabshelp">
        <li class="{{ ($page==1)?'active':'' }}"><a data-toggle="tab" href="#home"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Order Information</a></li>
        <li class="{{ ($page==2)?'active':'' }}"><a data-toggle="tab" href="#menu1"><i class="fa fa-truck" aria-hidden="true"></i> Shipping & Delivery</a></li>
        <li class="{{ ($page==3)?'active':'' }}"><a data-toggle="tab" href="#menu2"><i class="fa fa-credit-card" aria-hidden="true"></i> Billing & Payments</a></li>
        <li class="{{ ($page==4)?'active':'' }}"><a data-toggle="tab" href="#menu3"><i class="fa fa-money" aria-hidden="true"></i> Return & Refund Policy</a></li>
        <li class="{{ ($page==5)?'active':'' }}"><a data-toggle="tab" href="#menu4"><i class="fa fa-archive" aria-hidden="true"></i> Product Warranty</a></li>
        <li class="{{ ($page==6)?'active':'' }}"><a data-toggle="tab" href="#menu5"><i class="fa fa-th-large" aria-hidden="true"></i> Product Size Charts</a></li>
        <li class="{{ ($page==7)?'active':'' }}"><a data-toggle="tab" href="#menu6"><i class="fa fa-plane" aria-hidden="true"></i> Export</a></li>
        <li class="{{ ($page==8)?'active':'' }}"><a data-toggle="tab" href="#menu7"><i class="fa fa-question-circle" aria-hidden="true"></i> FAQ</a></li>
        <li class="{{ ($page==9)?'active':'' }}"><a data-toggle="tab" href="#menu8"><i class="fa fa-cloud-download" aria-hidden="true"></i> Download Center</a></li>
        <li class="{{ ($page==10)?'active':'' }}"><a data-toggle="tab" href="#menu9"><i class="fa fa-book" aria-hidden="true"></i> Terms of Services</a></li>
        <li class="{{ ($page==11)?'active':'' }}"><a data-toggle="tab" href="#menu10"><i class="fa fa-user-secret" aria-hidden="true"></i> Privacy Policy</a></li>
    </ul>

    <div class="tab-content" id="help-main-body">
        <div id="home" class="tab-pane fade {{ ($page==1)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.png" alt="">-->
                <div class="top-con-text">
                    <h2>Order Information</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
            <div class="con-text">
                <h4>Viewing & Tracking Your Order</h4>
                <p>Customer can view or track their order, as well as see their past order history by visiting <a href="https://www.mydorpon.com/"  target="_blank">Your Orders</a>. Please note that a login will be required.</p>

                <h4>Order Processing</h4>
                <p>Orders received prior to 1:30 PM Bangladesh Standard Time (BST) will be processed within the same business day provided that the goods are in stock and customer identification is verified. To ensure that orders placed online prior to 1:30 PM BST will ship the same day, please review our “Payment Methods” section below and double check product availability with <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a> customer service. After hour, weekend, and holiday orders will be processed the next business day.</p>
                <p>After an order is placed, the customer will receive an order confirmation via email. If there are any discrepancies with your order please contact <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a> as soon as possible to correct the issue. When the order ships, a shipment tracking number will be provided to the customer via email. To track your package, please refer to the Orders Center. Please note that a login will be required.</p>

                <h4>Order Changes & Cancellations</h4>
                <p>Because, we are always striving to ship orders as quickly as possible, there is a limited amount of time during which we can modify or cancel your order. If you would like to attempt to modify or cancel your order, please e-mail us at <a href="mailto: order@mydorpon.com">order@mydorpon.com</a> and include your order number and change/cancellation request or visit our Customer Service center to request the same.</p>

                <p><span style="font-weight:bold;">Note:</span> <span style="font-style: italic;">Orders placed through any company other than Jomashop.com cannot be altered. For example, shipping address changes can only be made for orders placed directly through <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a></span></p>
                <p>We will respond to your request to let you know if we were able to modify or cancel the order. Please note that if you did not receive a reply from Jomashop.com then your request to modify or cancel the order has not been affected.</p>
                <h4>Need Help?</h4>
                <p>Contact a member of our customer service team by:</p>
                <ul>
                    <li>Calling us at: (02) 5503 5760</li>
                    <li>Mailing us at: <a href="mailto: mail.finova@gmail.com">mail.finova@gmail.com</a></li>
                </ul>
            </div>
        </div>
        <div id="menu1" class="tab-pane fade {{ ($page==2)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/shipping.png" alt="">-->
                <div class="top-con-text">
                    <h2>Shipping & Delivery</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
            <div class="con-text">
                <p>We provide doorstep delivery process for every purchase. Once you confirm your order, we will start processing one address delivery request. If you want to send products in multiple addresses, we would suggest you to place separate orders for each products and make payments separately.  You can likewise check whether our delivery service is available at your doorsteps or not though we provide delivery service at any place of within Bangladesh.</p>
                <h4>Delivery Time</h4>
                <p>With a single click at <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a> we will deliver your shopping products to you at your doorsteps within 3-5 working days.</p>
                <h4>Real Time Tracking</h4>
                <p>Once an order has been successfully placed, you will be able to track the location of your order directly through link provided in your order tracking detailed page. </p>
                <h4>International Delivery</h4>
                <p>Currently our delivery service is available only within Bangladesh and currently we are unable to offer our delivery service internationally</p>
                <h4>Possible Delay</h4>
                <p>We are committed to provide rapid delivery service to our valuable buyers but due to unavoidable conditions (e.g., political unrest, natural calamities etc.) delivery can be delayed.</p>
                <h4>Gift Delivery</h4>
                <p>If the order is a gift, the package will be marked "Gift," but the price of the items and delivery charge us to declare the value of the gift item directly on the package.</p>
                <h4>Shipping & Delivery Charges</h4>
                <p>You just need to enter your address and our system will automatically show you the shipping charges and estimated delivery date. The details shipping & delivery charges are given below</p>


                <table style="width:100%">

                    <tr>
                        <th scope="col">Zone</th>
                        <th scope="col">Location</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Charges (Tk.)</th>
                    </tr>

                    <!--
                                           <tr>
                        <th>Zone</th>
                        <th>Locations</th>
                        <th>Weight</th>
                        <th>Charges (Tk.)</th>
                      </tr>
                    -->
                    <tr>
                        <td rowspan="3">Zone 1</td>
                        <td rowspan="3">Dhaka</td>
                        <td>Less Than 1 Kg</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>Less Than 2 Kg</td>
                        <td>90</td>                  </tr>
                    <tr>
                        <td>Less Than 6 Kg</td>
                        <td>210</td>                  </tr>


                    <tr>
                        <td rowspan="3">Zone 2</td>
                        <td rowspan="3">Chittagong, Sylhet, Mymensingh, Barisal, Khulna, Gazipur, Jhinaidah, Rajshahi, Rangpur</td>
                        <td>Less Than 1 Kg</td>
                        <td>90</td>
                    </tr>
                    <tr>
                        <td>Less Than 2 Kg</td>
                        <td>160</td>                  </tr>
                    <tr>
                        <td>Less Than 6 Kg</td>
                        <td>370</td>                  </tr>

                    <tr>
                        <td rowspan="3">Zone 3</td>
                        <td rowspan="3">Other than Zone 1 & Zone 2</td>
                        <td>Less Than 1 Kg</td>
                        <td>120</td>
                    </tr>
                    <tr>
                        <td>Less Than 2 Kg</td>
                        <td>190</td>                  </tr>
                    <tr>
                        <td>Less Than 6 Kg</td>
                        <td>400</td>                  </tr>


                </table>

            </div>
        </div>
        <div id="menu2" class="tab-pane fade {{ ($page==3)?' in active':'' }}">
            <div class="top-con">

                <div class="top-con-text">
                    <h2>Billing & Payments</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                    <img src="{{ asset('public/images/default/payments.png') }} " alt="">
                </div>
            </div>
            <div class="con-text">
                <p>We provide following payment options for our valuable customers at Dorpon</p>

                <ol>
                    <li>Cash On Delivery (COD)</li>
                    <li>Credit Card</li>
                    <li>Debit Card</li>
                    <li>bKash</li>
                    <li>Rocket</li>
                </ol>
                <p>Once your order has been confirmed, a system generated bill will be shown in your Dorpon’s account and you can make payment through credit card, debit card, bKash or Rocket as well as you can also choose Cash on Delivery mode. Your billing amount will be shown in Bangladesh Taka. Moreover, an invoice slip will be sent to your e-mail and you can also print it out which you need to use  when you will be returning your products.</p>

                <h4>Cash On Delivery</h4>
                <p>When your ordered products will be delivered on your doorsteps, you can make payment in cash to our delivery person.</p>
                <h4>Credit Card</h4>
                <p>Your total bill amount of your order will be charged from your credit card once you choose to pay credit card for payment method. Your order will not be confirm if the amount charged exceed your credit card limits or credit card declines to accept the transaction.</p>
                <h4>Debit Card</h4>
                <p>Your total bill amount of your order will be charged from your debit card once your debit card has approved and receipt will be generated.</p>
                <h4>bKash</h4>
                <p>You can also make payment through bKash account to our merchant wallet and you need to give reference number in the invoice slip which will be generated once you will choose bKash as method of payment.</p>
                <h4>Rocket</h4>
                <p>You can also make payment through Rocket account and you need to give reference number in the invoice slip which will be generated once you will choose Rocket as method of payment.</p>
            </div>
        </div>
        <div id="menu3" class="tab-pane fade {{ ($page==4)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.pn" alt="">-->
                <div class="top-con-text">
                    <h2>Return & Refund Policy</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
            <div class="con-text">
                <p>We want you to love your purchase! If you are not completely satisfied, let us know and we will work with you to make it right. Please note: due to the handmade nature of our products, there may be slight variation and imperfections in some items. We believe this is one of the beautiful things about owning a handmade item.</p>

                <p>At Dorpon, we provide best quality pictures of your desired products with the exact measurements, and information and pictures . Your order will start processing once you confirm it but we also try to accommodate you with “No Questions Asked” return policy, as we know sometimes people purchase something that doesn’t work out the way they had hoped for. If you are not satisfied with the product you have purchased just simply give it back to the delivery person and further we will start processing for their credit refund procedure, if any.</p>
                <h4>What qualifies as a return?</h4>
                <p>Buyer can return any of the purchased products, if the product meets any of the following conditions</p>
                <ol>
                    <li>Damaged product</li>
                    <li>Wrong product, size, or color</li>
                    <li>Poor quality product</li>
                    <li>Damaged product</li>
                    <li>Inconsistent with the description provided</li>
                    <li>Dissatisfied with delivered product </li>

                </ol>

                <h4>How to return purchased product?</h4>
                <p>Buyer can return the purchased products by any of the following way</p>
                <ol>
                    <li>Buyer can easily give back the purchased product to the delivery person   once the delivery is being made along with the invoice slip.</li>
                    <li>Buyer can also send back the purchased product (without opening the product package) to Dorpon office address within three (03) days along with the invoice slip.</li>
                </ol>

                <h4>Who will bear delivery charge?</h4>
                <p>When Buyer will return the purchased product, the following conditions will be applicable for bearing the delivery charge</p>
                <ol>
                    <li>If buyer is delivered with physically damaged, wrong product, size or color then buyer will not bear delivery charge for that specific purchase.</li>
                    <li>If the product has not worked out anyhow for buyer or buyer is not satisfied with the delivered product then s/he needs to bear the delivery charge for that specific purchase as well as 10% of the product price as refund management fees.</li>
                </ol>
                <h4>Mode of Refund</h4>
                <ol>
                    <li>If buyer chooses to purchase product in ‘Cash on delivery’ mode, once s/he returns the product with delivery person, s/he does not need to pay the bill for purchasing product except the delivery charge.</li>
                    <li>If buyer chooses to purchase product in ‘Cash on delivery’ mode, once s/he returns the product to Dorpon’s office, her/his made payment for purchased products will be refund to his preferred method for transaction such as Bank, bKash or Rocket within seven (07) days.</li>
                    <li>If buyer chooses to purchase products in ‘Electronic Fund Transfer (EFT)’ mode, once s/he returns the product to delivery person or at Dorpon’s office, her/his made payment for purchased products will be refund to her/his preferred method for transaction such as Bank, bKash or Rocket within seven (07) days.</li>
                </ol>

                <h4>How will buyer confirm that the refund is made?</h4>
                <p>Buyer will receive a confirmation note in her/his preferred method of contact such as (email or Mobile) regarding her/his refund.</p>
            </div>
        </div>
        <div id="menu4" class="tab-pane fade {{ ($page==5)?' in active':'' }}">
            <div class="top-con">
                <div class="top-con-text">
                    <h2>Product Warranty</h2>
                    <img src="underconstruction.png" alt="">
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
        </div>
        <div id="menu5" class="tab-pane fade {{ ($page==6)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.pn" alt="">-->
                <div class="top-con-text">
                    <h2>Product Size Charts</h2>
                    <img src="{{ asset('public/images/default/underconstruction.png') }} " alt="">
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
        </div>
        <div id="menu6" class="tab-pane fade {{ ($page==7)?' in active':'' }}">
            <div class="top-con">
                <div class="top-con-text">
                    <h2>Exports</h2>
                    <img src="{{ asset('public/images/default/underconstruction.png') }} " alt="">
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
        </div>
        <div id="menu10" class="tab-pane fade {{ ($page==11)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.png" alt="">-->
                <div class="top-con-text">
                    <h2>Privacy Policy</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>

            <div class="con-text">
                <p>This is Dorpon’s privacy policy. It sets out what information we will collect and how we will use that information. By using our website, you agree to its terms. This Privacy Policy is intended to inform you about the rules and procedure adopted by Dorpon with regards to the processing of data collected when you browse the website <a href="https://www.mydorpon.com">www.mydorpon.com</a> and when you use its features, as well as to inform you about the applicable security and confidentiality measures. Dorpon recognizes the importance of protecting your personal information. Thus we have developed a set of security measures designed to protect all your information.</p>

            </div>

            <button class="accordion">What kind of information Dorpon does gather?</button>
            <div class="panel">
                <p>You do not have to provide us with personal information, but some features on Dorpon’s website (including placing orders) can only be used if you provide personal information, and if you choose not to provide this information, you will not be able to use these features. We use information which you provide to deliver website services to you, to customize your shopping experience, and to communicate with you regarding promotional offers and our products and services. If you place an order with us, we will use information provided by you to process and complete that order, including handling payments and delivery. If you choose to register for an account on this website, we will use the information to provide and operate that account, and will also use it to communicate with you regarding our products and services and gather feedback from your end. Moreover, we may collect two types of information via this website: information you specifically provide to us another one is automatic information associated with your use of Dorpon’s website. Information you specifically provide to us includes any information you enter into a form or send to us via e-mail. Examples of this information includes information you enter when placing an order or setting up an account. Automatic information associated with your use of this site includes any information arising from your use of this site which you do not specifically provide. An example of this information includes your IP address, the type of web browser you are using, and the speed of your web connection.</p>
            </div>

            <button class="accordion">When Dorpon does gather information?</button>
            <div class="panel">
                <p>Once you do the below mentioned things, we gather your information</p>

                <ul>
                    <li>When you Register on our website at <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a></li>
                    <li>When you purchase, order, return</li>
                    <li>When you Track your placed order through Dorpon’s website</li>
                    <li>When you provide us proper feedback, comment regarding our products and services</li>
                    <li>When you get promotional offers, newsletters via emails</li>
                </ul>
            </div>

            <button class="accordion">What about Cookies?</button>
            <div class="panel">
                <p>Our website may use cookies to enable certain functionality. Cookies are small files which your web browser receives from us. They allow your web browser to identify you to Dorpon’s website so that you can take advantage of personalized features. Most web browsers provide options to disable cookies, but this may prevent you from using all of the features on our site. For this reason we recommend you leave cookies turned on.</p>
            </div>

            <button class="accordion">Does Dorpon share your information?</button>
            <div class="panel">
                <p>You may be asked for information that identifies you, such as your name, address, e-mail mobile phone number when you contact our customer service representatives with a question, feedback or comments or once you order or purchase by using Dorpon’s website. We collect this information to verify your identity and to help us promptly answers your question or respond to your comment or feedback or to complete your order so properly. We may retain this information to assist you in the future. We may also use your feedback, suggestions and comments to improve our products, website and services but we never share your information without prior your permission to anyone.</p>
            </div>

            <button class="accordion">How secure your information is?</button>
            <div class="panel">
                <p>We work hard to keep your information secure, and to comply with data protection and privacy laws as your privacy is important to us.  We do not enclose or give away the information you provide to us. We do not retain payment card information, other than the last four digits of your card number which is used for confirmation when dealing with confirming orders or returns. When you contact our representatives of customer service department they may request verification of your identity to protect the privacy of any information you have provided to us. </p>
            </div>

            <button class="accordion">Information we share</button>
            <div class="panel">
                <p>We will sometimes send you information about special offers for Dorpon’s valuable customers from our artisans or sellers, or allow them to do so. We use service providers to process data and online payments, deliver our products and services, host our website, send emails, run our promotions and surveys, to help us better understand your use of our website, and to improve our website. All of our service providers are required to maintain the confidentiality and security of your personal information and to use it only in compliance with applicable privacy laws. These service providers are not authorized to use your information in any manner, other than in helping us to provide you with products and services or as otherwise required by the law. Where we allow them to do this, we will still control the information used and they will not receive any information about you unless we specifically provide it to them.</p>
            </div>

            <button class="accordion">What information you can access?</button>
            <div class="panel">
                <p>If you choose to create an account, you will be able to manage your personal data online via your account. If you do not choose to do so, you will not be able to view or modify this information. However, you can access all the relevant information about products given on Dorpon’s website and can able to place order, can track your order and modify your order as well. If you wish to change any preferences and you have not created an account, please contact us at +880 255035760 or write to us at <a href="mailto:mail.finova@gmail.com">mail.finova@gmail.com</a></p>
            </div>

            <button class="accordion">What Choices do you have?</button>
            <div class="panel">
                <ul>
                    <li>You have the right not to provide your personal information to us which are not mandatory (e.g. Gender, DOB) to register as user/buyer of Dorpon</li>
                    <li>As you have an option to register as user/buyer of Dorpon by using your Social Media account (e.g. Facebook, Twitter, Instagram, Google Plus)  from where we will be generating your basic general information, you can avoid using your social media account to register as user/buyer</li>
                    <li>You can avoid providing your card (Debit/Credit) information while purchasing product from Dorpon’s website rather can use Cash On Delivery method</li>
                    <li>You can avoid receiving e-mails, newsletters from us by confirming it with our customer service representative</li>

                </ul>
            </div>
            <button class="accordion">Changes of Privacy Policy</button>
            <div class="panel">
                <p>Dorpon reserves the right to change this Privacy Policy without prior notice to its users. Whenever Dorpon updates its Privacy Policy, it will be immediately available there, indicating the date of publication. The user/buyer should make regular visits to this Privacy Policy, as we consider that you accept and agree to these terms. If you disagree with the changes to the Privacy Policy, you should not continue to navigate the Dorpon’s website.</p>
                <p>If you have any questions or queries about our privacy policy, please contact with us at +880 2 55035760 or write to us at <a href="mailto:mail.finova@gmail.com">mail.finova@gmail.com</a></p>

            </div>

        </div>
        <div id="menu8" class="tab-pane fade {{ ($page==9)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.pn" alt="">-->
                <div class="top-con-text">
                    <h2>Download Center</h2>
                    <img src="{{ asset('public/images/default/underconstruction.png') }} " alt="">
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
        </div>
        <div id="menu9" class="tab-pane fade {{ ($page==10)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.png" alt="">-->
                <div class="top-con-text">
                    <h2>Terms of Services</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
            <div class="con-text">
                <p>You (“User” or “Buyer”) are required to read and accept all of the terms of services laid down in this Terms of services and the linked Privacy Policy, before you may use <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a> (hereinafter referred to as “Dorpon”). Dorpon allows you to browse, select and purchase it’s all kinds of products or items.</p>

                <p>These Terms of services are effective upon acceptance and governs the relationship between you and Dorpon.</p>

                <p>If you do not agree to be bound by these Terms of services and the Privacy Policy, you may not use the Dorpon in any way. For the purposes of this TERMS OF SERVICES the term ‘Acceptance’ shall mean your affirmative action in clicking on ‘View Terms of Services’  and on the ‘Continue’ as provided on the registration page or such other actions that implies your acceptance.</p>

                <h4>Privacy Policy</h4>
                <p>Please review our <a href="">Privacy Policy</a> which also manage and direct you to use Dorpon’s website.</p>

                <h4>Changes of Terms of Services</h4>
                <p>Terms of services may change any way as Dorpon may revise or modify or review the terms of services when require. Dorpon will post the terms of services at any time by posting a revised version or Dorpon’s web page. All updates and amendments shall be notified to you via posts on website or through e-mail. The revised version will be effective at the time we post it on the website, and in the event you continue to use Dorpon;s website, you are impliedly agreeing to the revised Terms of Services and Privacy Policy expressed herein. If you have any query regarding our terms of services, feel free to contact us at <a href="mailto: mail.finova@gmail.com">mail.finova@gmail.com</a> or +880 2-5505760.</p>

                <h4>Availability of Products</h4>
                <p>As Dorpon’s aim is to feature handcrafted and self-produced products of artisans, the quantity of the products can be available for limited time period. Depending on the nature of the products, the products can be out of stock for good or can be restocked again at Dorpon. When an item featured on my.dorpon.com is no longer in stock, we make every attempt to remove that item from the website or labeled as ‘Stock out’ in a timely manner. If you have any questions regarding the availability of any particular product, you can contact us at <a href="mailto: mail.finova@gmail.com">mail.finova@gmail.com</a> or +880 2-5505760.</p>

                <h4>Product Information</h4>
                <p>This is to inform you that thinking about the laws of Bangladesh on shippable things, delicacy and different limitations; <a href="https://www.mydorpon.com/" target="_blank">www.mydorpon.com</a>  does not convey each thing that you would discover in our Dorpon’s platform. The costs showed at Dorpon are cited in Bangladeshi Taka (BDT). Our feature products are mostly handcrafted, so we follow the below described rules and regulations</p>
                <ul>
                    <li><span style="font-weight:bold;">Handcrafted:</span> Since Dorpon features handcrafted items within the Bangladesh and most of the products of Dorpon are handcrafted, we cannot ensure you that the product you are purchasing will be the same as online though every effort is made for it to be a very close match.</li>
                    <li><span style="font-weight:bold;">Colors:</span> We have given every effort to display as accurately as the product colors which is appeared in our website. However, due to visual discrepancies of computer, laptop, tablet, mobile phone, we can’t certify that your display of color will be same.</li>
                    <li><span style="font-weight:bold;">Pricing:</span> Pricing cited in <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a> is being quoted by the seller. If due to any technical discrepancies wrong pricing has cited then Dorpon hold the right of cancel that order by informing you through your preferred method of communication.</li>
                    <li><span style="font-weight:bold;">Payment:</span> Dorpon hold the right to cancel any order if the credit card has been not charged or declined. If your credit card has been charged then Dorpon will start processing refund you back through your preferred method of transaction.</li>
                    <li><span style="font-weight:bold;">Delivery Charge:</span> Our delivery charges are planned to repay assigned dispatching organizations in accumulation taking care of the expense of preparing your request, taking care of and pressing the purchased items and delivering them to you.</li>
                </ul>
                <h4>Cancellations by Dorpon</h4>
                <p>Please note that there may be certain orders that we are unable to accept and must cancel. We reserve the right, at our sole discretion, to refuse or cancel any order for any reason. Some situations that may result in your order being cancelled shall include limitations on quantities available for purchase, inaccuracies or errors in product or pricing information, or any defect regarding the quality of the product. We may also require additional verifications or information before accepting any order. We will contact you if all or any portion of your order is cancelled or if additional information is required to accept your order. If your order is cancelled after your purchased amount has been charged, the said amount will be reversed back in your preferred method of transactions.</p>

                <h4>Cancellations by Buyer or User</h4>
                <p>In case of requests for order cancellations, we reserve the right to accept or reject requests for order cancellations for any reason. As part of usual business practice, if we receive a cancellation notice and the order has not been processed / approved by us, we shall cancel the order and refund the entire amount. A request for cancellation of order shall be valid and accepted only if they are made within 24 (twenty four) hours of making the order on the Dorpon’s website. We will not be able to cancel orders that have already been processed or orders for which request for cancellation is made after the expiry of 24 (twenty hours) from making the order. We have the full right to decide whether an order has been processed or not. The User or Buyer agrees not to dispute the decision made by us and accepts our decision regarding the cancellation.</p>

                <h4>Pricing Information</h4>
                <p>While we strive to provide accurate product and pricing information, pricing or typographical errors may occur. In the event that a product is listed at an incorrect price or with incorrect information due to an error in pricing or product information, we may, at our discretion, either contact you for instructions or cancel your order and notify you of such cancellation. We will have the right to modify the price of the product and contact you for further instructions using the e-mail address or telephone number provided by you during the time of registration, or cancel the order and notify you of such cancellation. In the event that we accept your order the same shall be debited to your preferred method of transactions. The payment may be processed prior to our dispatch of the product that you have ordered. If we have to cancel the order after we have processed the payment, the said amount will be reversed back to your preferred method of transactions.</p>

                <h4>Fraudulent or Decline Transactions</h4>
                <p>We may constantly monitor the users' accounts in order to avoid fraudulent accounts and transactions. Users/Buyers with more than one account or availing our services fraudulently shall be liable for legal actions under applicable law and we reserve the right to recover the cost of goods, collection charges and lawyers’ fees from persons using the Dorpon’s platform fraudulently. We reserve the right to initiate legal proceedings against such persons for fraudulent use of the Site and any other unlawful acts or omissions in breach of these terms and conditions. In the event of detection of any fraudulent or declined transaction, prior to initiation of legal actions, we reserve the right to immediately delete such account and dishonor all past and pending orders without any liability. For the purpose of this clause, we shall owe no liability for any refunds.</p>

                <h4>Electronic Communication</h4>
                <p>When you use Dorpon’s website or send emails or other data, information or communication to us, you agree and understand that you are communicating with us through electronic records and you consent to receive communications via electronic records from us periodically and as and when required. We will communicate with you by email or by an electronic record on Dopron’s website which will be considered adequate service of notice / electronic record.</p>

                <h4>Equipment</h4>
                <p>The User shall be responsible for obtaining and maintaining telephone, computer hardware and other equipment needed for access to and use of Dopron’s platform and all charges related thereto. Dopron shall not be liable for any damages to the User's/ Buyer’s equipment resulting from the use of Dorpon.</p>


                <h4>Your Account</h4>
                <p>In consideration of your use of Dopron’s website, you represent that you are of legal age to form a binding contract and are not a person barred from receiving services under the laws as applicable in Bangladesh. You also agree to provide true, accurate, current and complete information about yourself as prompted by the Dorpon's registration form. If you provide any information that is untrue, inaccurate, not current or incomplete (or becomes untrue, inaccurate, not current or incomplete), or we have reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, We have the right to suspend or terminate your account and refuse any and all current or future use of the Site (or any portion thereof). If you use the Site, you are responsible for maintaining the confidentiality of your account and password including cases when it is being used by any of your family members, friends or relatives, whether a minor or an adult. You further agree to accept responsibility for all transactions made from your account and any dispute arising out of any misuse of your account, whether by any family member, friend, relative, any third party or otherwise shall not be entertained by Dorpon. Because of this, we strongly recommend that you ‘Sign Out’ from your account at the end of each session. You agree to notify us immediately of any unauthorized use of your account or any other breach of security. We reserve the right to refuse service, terminate accounts, or remove or edit content in our sole discretion.</p>
                <p>Access to and use of password protected and/or secure areas of Dorpon is restricted to authorized users only. Unauthorized individuals attempting to access these areas of Dopron may be subject to prosecution.</p>

                <h4>Your Information</h4>
                <p>"Your Information" is defined as any information you provide to us or other users of Doron in the user registration process, in the feedback area, bulletin board, chat service etc. or through any e-mail feature. You are solely responsible for Your Information, and in accordance with certain features of Dorpon we may only act as a passive channel for your online distribution and publication of Your Information.</p>

                <h4>Card & Other EFT Account Information</h4>
                <p>You agree, understand and confirm that card (Debit/Credit) details provided by you for availing of services at Dorpon will be correct and accurate and you shall not use card which is not lawfully owned by you, i.e. in a credit card transaction, you must use your own card. You further agree and undertake to provide the correct and valid card details to us. Further the said information will not be utilized and shared by us with any of the third parties unless required for fraud verifications or by law, regulation or court order. We will not be liable for any card fraud. The liability for use of a card fraudulently will be on you and the onus to 'prove otherwise' shall be exclusively on you. Same conditions apply for other EFT’s account as well.</p>

                <h4>Inaccuracy Disclaimer</h4>
                <p>There may be information on Dorpon’s website or in our newsletter that contains typographical errors, inaccuracies, or omissions that may relate to product descriptions, pricing, and availability. Dorpon reserves the right to correct any errors, inaccuracies or omissions and to change or update information at any time without prior notice. Any errors are wholly unintentional and we apologize if inaccurate information is reflected in price, item availability, or in any way affects your individual order.  We reserve the right to modify errors or to update product information at any time without prior notice.</p>

                <h4>Liability</h4>
                <p>You expressively understand and agree that Dorpon and its other affiliates shall not be liable to you for any direct, indirect, incidental, special damages including but not limited to, damages for loss of profits, opportunities, goodwill, data or other intangible losses. Resulting from use of Dorpon’s platform, sale and supply of products content or any related or unrelated services and other services offered on Dorpon from time to time.</p>

                <h4>Legal Informatio</h4>
                <ul>
                    <li><span style="font-weight:bold;">Trademarks & Copyright:</span>The trademarks, logos and service marks displayed on Dorpon’s website are our property and/or the property of the respective persons. Users/Buyers are prohibited from using any marks for any purpose whatsoever without our prior written permission or such third party which may own the marks. All information and content including any software programs available on or through Dorpon is protected by copyright. Users are prohibited from modifying, copying, distributing, transmitting, displaying, publishing, selling, licensing, creating derivative works or using any content available on or through Dorpon for commercial or public purposes.</li>
                    <li><span style="font-weight:bold;">Indemnity:</span>You shall to the fullest extent indemnify and hold harmless the organization, its subsidiaries and affiliates, and their respective officers, directors, shareholders, agents, and employees, from any claim or demand, or actions including reasonable lawyers' fees, made by any third party or penalty imposed due to or arising out of your breach of this Agreement, or the documents it incorporates by reference, or your violation of any law, rules or regulations or the rights of a third party.</li>
                    <li><span style="font-weight:bold;">Agreement:</span>If any clause of these terms of services shall be considered invalid, void or for any reason unenforceable, such clause shall be considered severable and shall not affect the validity and enforceability of the remaining clauses of the terms of services.</li>
                    <li><span style="font-weight:bold;">Governing Laws:</span>These terms of services and the privacy policy or the documents they incorporate by reference shall be governed and construed in accordance with the laws of Bangladesh.</li>
                </ul>

                <h4>Communications</h4>
                <p>We make every effort to respond rapidly to all your queries through emails and calls. We welcome all of your comments and feedbacks regarding our products and services. We will not disclose your name or other information without your prior permission. However, Dorpon’s website is maintained by Dorpon itself. To know more details regarding  Dorpon or any query you have please write to us at <a href="mailto: mail.finova@gmail.com"> mail.finova@gmail.com</a> or call us at +880 2 55035760.</p>
            </div>
        </div>
        <div id="menu7" class="tab-pane fade {{ ($page==8)?' in active':'' }}">
            <div class="top-con">
                <!--                   <img src="img/returnpolicy_cover.png" alt="">-->
                <div class="top-con-text">
                    <h2>Frequently Asked Questions</h2>
                    <!--                   <h3>Your Satisfaction is Our Priority</h3>-->
                </div>
            </div>
            <div class="con-text">

                <button class="accordion">How do I make a purchase?</button>
                <div class="panel">
                    <p>Shopping at <a href="https://www.mydorpon.com/"  target="_blank">www.mydorpon.com</a> is very easy.</p>
                    <ul>
                        <li>If you know what you are looking for e.g. Clothing of Men, Women, kids or Accessories or Home Décor or Nakshi Kantha, go to the links of those and choose your desire product.</li>
                        <li>Once you choose your desire product and decide to purchase it click on ‘Add to Cart’</li>
                        <li>Review and revised your cart again and click on ‘Confirm’ to proceed with your purchase </li>
                    </ul>

                </div>

                <button class="accordion">Do I need to create an account to place an order?</button>
                <div class="panel">
                    <p>Yes, to order products from Dorpon you need to create an account.</p>
                </div>

                <button class="accordion">I have forgotten my password. What should I do now?</button>
                <div class="panel">
                    <p>No issue at all. Just click on the ‘Forgot Password’ option in the Sign In page and follow the instructions, which are given there. </p>
                </div>

                <button class="accordion">Which size should I choose?</button>
                <div class="panel">
                    <p>All products at Dorpon’s are mostly sold by following international sizing scheme used by our artisans. But as sizes can vary greatly by artisans, we have provided the actual dimensions of each product for you to compare with your own body measurements. In addition, a details product size chart has provided in our website's Product Size Chart, you can also compare it out.</p>
                </div>

                <button class="accordion">Can I make shipment of my ordered products in different addresses?</button>
                <div class="panel">
                    <p>As we provide one address shipment service for per order, we would suggest you to place separate order for different addresses for different products.</p>
                </div>

                <button class="accordion">How can I track my order?</button>
                <div class="panel">
                    <p>To track your order please click here Track Dorpon’s Order and you will be redirected to our delivery service provider page and from there you will be able to track your order.</p>
                </div>

                <button class="accordion">What payment methods does Dorpon accept?</button>
                <div class="panel">
                    <p>No, you do not need to make any advance payment for Cash On Delivery.</p>
                </div>

                <button class="accordion">Is this safe to use my cards (Debit & Credit) while purchasing?</button>
                <div class="panel">
                    <p>At Dorpon, your personal online security is important to us. We use the latest SSL encryption technology to store and safely transmit your personal and card information through our systems. All orders are processed through a secure checkout system.</p>
                </div>

                <button class="accordion">When my card will be charged?</button>
                <div class="panel">
                    <p>Your card will be charged once it will be approved through respective bank’s secure payment gateway.</p>
                </div>

                <button class="accordion">Why my order is marked as Pending?</button>
                <div class="panel">
                    <p>To avoid the risk of fraudulent transactions, all the orders and payments are reviewed by our online risk fraudulent department or admin. Once your payment is approved, you will receive a notification via email and your order will be marked as 'Paid' automatically. The review process usually takes around 4-48 hours.</p>
                </div>

                <button class="accordion">Can I change my shipping address after my order has been dispatched?</button>
                <div class="panel">
                    <p>We are unfortunately unable to redirect orders once your products have been dispatched. Therefore, please ensure you provide a suitable shipping address for the specified delivery times.</p>
                </div>

                <button class="accordion">Can I add items to an existing order?</button>
                <div class="panel">
                    <p>Unfortunately, it is not possible to combine orders or add items to an existing order. If you would like all your items to be delivered together, you will need to cancel your order(s) and place a new order, which contains all the items you require.</p>
                </div>

                <button class="accordion">How will I know you received my order & when will payment be deducted if I use card?</button>
                <div class="panel">
                    <p>After you place your order, you will be sent an email confirming that it has been received. Your card will only be debited at time of dispatch. In the rare instance that any of the items you have ordered are not available but at our website showing available, we will contact you by email and will only charge your card for the value of the items in stock which you have ordered. </p>
                </div>

                <button class="accordion">Can I order a product as a gift?</button>
                <div class="panel">
                    <p>We can deliver to addresses whichever you will provide as shipment address but we don’t provide any gift-wrapping service.</p>
                </div>

                <button class="accordion">How are your products priced?</button>
                <div class="panel">
                    <p>Our prices are listed in Bangladeshi Taka. The price you are charged will always be the current selling price for the items you have ordered.</p>
                </div>

                <button class="accordion">How do I cancel my order?</button>
                <div class="panel">
                    <p>Once your order has been placed, it is not possible to cancel it before delivery.</p>
                </div>

                <button class="accordion">How do I return an item?</button>
                <div class="panel">
                    <p>Please go to Return & Refund policy or Click Here to know how you can return your purchased product.</p>
                </div>

                <button class="accordion">How long will it take to deliver?</button>
                <div class="panel">
                    <p>While placing an order, an estimated delivery date is shown to you for your reference purposes. For latest delivery information, please go to Shipping & Delivery or Click Here.</p>
                </div>

                <button class="accordion">How much does delivery cost?</button>
                <div class="panel">
                    <p>Different locations have different delivery costs. The delivery cost is calculated instantly during the checkout process and for more details please go to Shipping & delivery or Click Here.</p>
                </div>

                <button class="accordion">I have confirmed my order but later on I have been informed that my order got canceled? What has happened?</button>
                <div class="panel">
                    <p>There are few possibilities for happening this. They might be</p>
                    <ul>

                        <li>You have provided incorrect shipment address</li>
                        <li>You payment has declined by the payment gateway</li>
                        <li>The recipient of the shipment has denied to accept the order</li>
                    </ul>
                </div>

                <button class="accordion">Does Dorpon provide delivery service at outside Bangladesh?</button>
                <div class="panel">
                    <p>Currently, we are unable to provide delivery service outside Bangladesh but you can order from outside Bangladesh and we will deliver it to your friends & family who reside in Bangladesh.</p>
                </div>

                <button class="accordion">My order hasn't arrived yet, why it is taking this much time?</button>
                <div class="panel">
                    <p>Usually, it takes 3-5 working days to deliver your products after dispatching it from Dorpon’s end. If you don’t get it by then, we would be glad to help you by proving you proper service through our customer service, you can contact us at +8802 55035760 or feel free to write to us at mail.finova@gmail.com.</p>
                </div>

                <button class="accordion">What happens if the product I have ordered isn't in stock?</button>
                <div class="panel">
                    <p>Our Dorpon’s website system is designed to ensure that stock levels are always accurate, and that products ordered are available. Unfortunately, there may sometimes be errors, and occasionally products which are available from our website may be out of stock in our inventory or Artisan’s end. If this happens, we will only ship you any items from your order which are in stock and you will be informed from our end through email or SMS confirmation. You will not be charged for out of stock items.</p>
                </div>

                <button class="accordion">What happens if you can't deliver to my address?</button>
                <div class="panel">
                    <p>Sometimes there may be problems delivering to the address, which you have given us. If this happens, we will contact you to discuss this issue and will solve it by providing you an appropriate service from Dorpon’s end.</p>
                </div>

                <button class="accordion">Why do I need to give you an e-mail address?</button>
                <div class="panel">
                    <p>We need your e-mail address in order to send you important information about your order, including order confirmations and tracking details. Moreover, we will keep updating you with our promotional offers via emails. If you do not provide an e-mail address, you will not be able to order.</p>
                </div>

                <button class="accordion">How safe it is providing my residence address?</button>
                <div class="panel">
                    <p>Your all information is secure with us. We never share our buyer’s information to anyone without prior permission. You can choose not to provide your residence address to us as we will provide delivery service, which will be provided by you.</p>
                </div>

                <button class="accordion">How may I communicate with Artisans?</button>
                <div class="panel">
                    <p>Once you will be at an individual artisan’s shop at Dorpon’s place, you can communicate that artisan by chatting. Please note that, you can only communicate with an individual artisan within Dorpon’s platform regarding your desire products.</p>
                </div>

                <button class="accordion">Can I order customized product according to my choice?</button>
                <div class="panel">
                    <p>Yes, you can order customized product according to your choice to those artisans who are providing you this customization option. Please note no return policy is applicable for customized products.</p>
                </div>

                <button class="accordion">What types of products do you sell at Dorpon’s?</button>
                <div class="panel">
                    <p>Dorpon is mostly selling handcrafted items, e.g., Nakshi Kantha, Men’s Clothing, Women’s Clothing, Kid's Clothing, Jewelry & Accessories, Home Décor items which are made by creative handicraft workers of Bangladesh.</p>
                </div>
            </div><div id="menu1" class="tab-pane fade">

            </div>
        </div>

    </div>
</div>

@endsection

@section('footerLink')
    <script src="{{asset('public/frontEnd/js/jquery-1.9.1.min.js')}}"></script>
    <script>

        jQuery('.tabshelp .tab-links a').on('click', function(e)  {
            var currentAttrValue = jQuery(this).attr('href');

            // Show/Hide Tabs
            jQuery('.tabs ' + currentAttrValue).show().siblings().hide();

            // Change/remove current tab to active
            jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

            e.preventDefault();
        });
    </script>

    <script>
        var acc = document.getElementsByClassName("accordion");
        var x;

        for (x = 0; x < acc.length; x++) {
            ac        c[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>

@endsection