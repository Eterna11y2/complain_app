@extends('admin_master')
@section('admin_content')
 <!-- GOOGLE FONTS -->
 <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />

<link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

<!-- PLUGINS CSS STYLE -->
<link href="assets/plugins/simplebar/simplebar.css" rel="stylesheet" />
<link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />

<!-- No Extra plugin used -->








<link href='assets/plugins/data-tables/datatables.bootstrap4.min.css' rel='stylesheet'>

<link href='assets/plugins/data-tables/jquery.datatables.min.css' rel='stylesheet'>

<!-- SLEEK CSS -->
<link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />

<!-- FAVICON -->
<link href="assets/img/favicon.png" rel="shortcut icon" />

<!--
  HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
-->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="assets/plugins/nprogress/nprogress.js"></script>

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-contact">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Add a form to edit the category -->
        <form method="POST" id="UpdateCatName">
          @csrf
          <input type="hidden" name="id" id="editCategoryId">
          <div class="form-group">
            <label for="editCategoryName">Name:</label>
            <input type="text" class="form-control" id="editCategoryName" name="name">
          </div>
          <div id="message"></div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="editCategoryButton">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->
<div class="row">
            <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
              <!-- Recent Order Table -->
              <div class="card card-table-border-none recent-orders" id="recent-orders">
                <div class="card-header justify-content-between">
                  <h2>Manage Category</h2>
                  <div class="">
                  <div class="col-sm-12 col-md-12 text-center">
                        <form action = "/admin/add_category" method ="POST" class="form-inline">
                            @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name = "category-name"id="exampleInputName2" placeholder="Add new category here!">
                        </div>
                        <button type="submit" class="btn btn-success mx-2">Add</button>
                        </form>
                  </div>
                </div>
                <div class="card-body pt-0 pb-5 col-md-12">
                    
                <div class="expendable-data-table">
					<table id="expendable-data-table" class="table display nowrap" style="width:100%">
						<thead>
							<tr>
								<th></th>
								<th>First name</th>
								<th>Last name</th>
								<th>Position</th>
								<th>Office</th>
								<th>Age</th>
								<th>Start date</th>
								<th>Salary</th>
								<th>Extn.</th>
								<th>E-mail</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td class="details-control"></td>
								<td>Tiger</td>
								<td>Nixon</td>
								<td>System Architect</td>
								<td>Edinburgh</td>
								<td>61</td>
								<td>2011/04/25</td>
								<td>$320,800</td>
								<td>5421</td>
								<td>t.nixon@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Garrett</td>
								<td>Winters</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>63</td>
								<td>2011/07/25</td>
								<td>$170,750</td>
								<td>8422</td>
								<td>g.winters@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Ashton</td>
								<td>Cox</td>
								<td>Junior Technical Author</td>
								<td>San Francisco</td>
								<td>66</td>
								<td>2009/01/12</td>
								<td>$86,000</td>
								<td>1562</td>
								<td>a.cox@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Cedric</td>
								<td>Kelly</td>
								<td>Senior Javascript Developer</td>
								<td>Edinburgh</td>
								<td>22</td>
								<td>2012/03/29</td>
								<td>$433,060</td>
								<td>6224</td>
								<td>c.kelly@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Airi</td>
								<td>Satou</td>
								<td>Accountant</td>
								<td>Tokyo</td>
								<td>33</td>
								<td>2008/11/28</td>
								<td>$162,700</td>
								<td>5407</td>
								<td>a.satou@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Brielle</td>
								<td>Williamson</td>
								<td>Integration Specialist</td>
								<td>New York</td>
								<td>61</td>
								<td>2012/12/02</td>
								<td>$372,000</td>
								<td>4804</td>
								<td>b.williamson@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Herrod</td>
								<td>Chandler</td>
								<td>Sales Assistant</td>
								<td>San Francisco</td>
								<td>59</td>
								<td>2012/08/06</td>
								<td>$137,500</td>
								<td>9608</td>
								<td>h.chandler@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Rhona</td>
								<td>Davidson</td>
								<td>Integration Specialist</td>
								<td>Tokyo</td>
								<td>55</td>
								<td>2010/10/14</td>
								<td>$327,900</td>
								<td>6200</td>
								<td>r.davidson@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Colleen</td>
								<td>Hurst</td>
								<td>Javascript Developer</td>
								<td>San Francisco</td>
								<td>39</td>
								<td>2009/09/15</td>
								<td>$205,500</td>
								<td>2360</td>
								<td>c.hurst@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Sonya</td>
								<td>Frost</td>
								<td>Software Engineer</td>
								<td>Edinburgh</td>
								<td>23</td>
								<td>2008/12/13</td>
								<td>$103,600</td>
								<td>1667</td>
								<td>s.frost@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Jena</td>
								<td>Gaines</td>
								<td>Office Manager</td>
								<td>London</td>
								<td>30</td>
								<td>2008/12/19</td>
								<td>$90,560</td>
								<td>3814</td>
								<td>j.gaines@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Quinn</td>
								<td>Flynn</td>
								<td>Support Lead</td>
								<td>Edinburgh</td>
								<td>22</td>
								<td>2013/03/03</td>
								<td>$342,000</td>
								<td>9497</td>
								<td>q.flynn@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Charde</td>
								<td>Marshall</td>
								<td>Regional Director</td>
								<td>San Francisco</td>
								<td>36</td>
								<td>2008/10/16</td>
								<td>$470,600</td>
								<td>6741</td>
								<td>c.marshall@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Haley</td>
								<td>Kennedy</td>
								<td>Senior Marketing Designer</td>
								<td>London</td>
								<td>43</td>
								<td>2012/12/18</td>
								<td>$313,500</td>
								<td>3597</td>
								<td>h.kennedy@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Tatyana</td>
								<td>Fitzpatrick</td>
								<td>Regional Director</td>
								<td>London</td>
								<td>19</td>
								<td>2010/03/17</td>
								<td>$385,750</td>
								<td>1965</td>
								<td>t.fitzpatrick@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Michael</td>
								<td>Silva</td>
								<td>Marketing Designer</td>
								<td>London</td>
								<td>66</td>
								<td>2012/11/27</td>
								<td>$198,500</td>
								<td>1581</td>
								<td>m.silva@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Paul</td>
								<td>Byrd</td>
								<td>Chief Financial Officer (CFO)</td>
								<td>New York</td>
								<td>64</td>
								<td>2010/06/09</td>
								<td>$725,000</td>
								<td>3059</td>
								<td>p.byrd@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Gloria</td>
								<td>Little</td>
								<td>Systems Administrator</td>
								<td>New York</td>
								<td>59</td>
								<td>2009/04/10</td>
								<td>$237,500</td>
								<td>1721</td>
								<td>g.little@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Bradley</td>
								<td>Greer</td>
								<td>Software Engineer</td>
								<td>London</td>
								<td>41</td>
								<td>2012/10/13</td>
								<td>$132,000</td>
								<td>2558</td>
								<td>b.greer@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Dai</td>
								<td>Rios</td>
								<td>Personnel Lead</td>
								<td>Edinburgh</td>
								<td>35</td>
								<td>2012/09/26</td>
								<td>$217,500</td>
								<td>2290</td>
								<td>d.rios@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Jenette</td>
								<td>Caldwell</td>
								<td>Development Lead</td>
								<td>New York</td>
								<td>30</td>
								<td>2011/09/03</td>
								<td>$345,000</td>
								<td>1937</td>
								<td>j.caldwell@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Yuri</td>
								<td>Berry</td>
								<td>Chief Marketing Officer (CMO)</td>
								<td>New York</td>
								<td>40</td>
								<td>2009/06/25</td>
								<td>$675,000</td>
								<td>6154</td>
								<td>y.berry@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Caesar</td>
								<td>Vance</td>
								<td>Pre-Sales Support</td>
								<td>New York</td>
								<td>21</td>
								<td>2011/12/12</td>
								<td>$106,450</td>
								<td>8330</td>
								<td>c.vance@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Doris</td>
								<td>Wilder</td>
								<td>Sales Assistant</td>
								<td>Sidney</td>
								<td>23</td>
								<td>2010/09/20</td>
								<td>$85,600</td>
								<td>3023</td>
								<td>d.wilder@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Angelica</td>
								<td>Ramos</td>
								<td>Chief Executive Officer (CEO)</td>
								<td>London</td>
								<td>47</td>
								<td>2009/10/09</td>
								<td>$1,200,000</td>
								<td>5797</td>
								<td>a.ramos@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Gavin</td>
								<td>Joyce</td>
								<td>Developer</td>
								<td>Edinburgh</td>
								<td>42</td>
								<td>2010/12/22</td>
								<td>$92,575</td>
								<td>8822</td>
								<td>g.joyce@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Jennifer</td>
								<td>Chang</td>
								<td>Regional Director</td>
								<td>Singapore</td>
								<td>28</td>
								<td>2010/11/14</td>
								<td>$357,650</td>
								<td>9239</td>
								<td>j.chang@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Brenden</td>
								<td>Wagner</td>
								<td>Software Engineer</td>
								<td>San Francisco</td>
								<td>28</td>
								<td>2011/06/07</td>
								<td>$206,850</td>
								<td>1314</td>
								<td>b.wagner@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Fiona</td>
								<td>Green</td>
								<td>Chief Operating Officer (COO)</td>
								<td>San Francisco</td>
								<td>48</td>
								<td>2010/03/11</td>
								<td>$850,000</td>
								<td>2947</td>
								<td>f.green@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Shou</td>
								<td>Itou</td>
								<td>Regional Marketing</td>
								<td>Tokyo</td>
								<td>20</td>
								<td>2011/08/14</td>
								<td>$163,000</td>
								<td>8899</td>
								<td>s.itou@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Michelle</td>
								<td>House</td>
								<td>Integration Specialist</td>
								<td>Sidney</td>
								<td>37</td>
								<td>2011/06/02</td>
								<td>$95,400</td>
								<td>2769</td>
								<td>m.house@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Suki</td>
								<td>Burks</td>
								<td>Developer</td>
								<td>London</td>
								<td>53</td>
								<td>2009/10/22</td>
								<td>$114,500</td>
								<td>6832</td>
								<td>s.burks@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Prescott</td>
								<td>Bartlett</td>
								<td>Technical Author</td>
								<td>London</td>
								<td>27</td>
								<td>2011/05/07</td>
								<td>$145,000</td>
								<td>3606</td>
								<td>p.bartlett@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Gavin</td>
								<td>Cortez</td>
								<td>Team Leader</td>
								<td>San Francisco</td>
								<td>22</td>
								<td>2008/10/26</td>
								<td>$235,500</td>
								<td>2860</td>
								<td>g.cortez@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Martena</td>
								<td>Mccray</td>
								<td>Post-Sales support</td>
								<td>Edinburgh</td>
								<td>46</td>
								<td>2011/03/09</td>
								<td>$324,050</td>
								<td>8240</td>
								<td>m.mccray@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Unity</td>
								<td>Butler</td>
								<td>Marketing Designer</td>
								<td>San Francisco</td>
								<td>47</td>
								<td>2009/12/09</td>
								<td>$85,675</td>
								<td>5384</td>
								<td>u.butler@datatables.net</td>
							</tr>
							
							<tr>
								<td class="details-control"></td>
								<td>Howard</td>
								<td>Hatfield</td>
								<td>Office Manager</td>
								<td>San Francisco</td>
								<td>51</td>
								<td>2008/12/16</td>
								<td>$164,500</td>
								<td>7031</td>
								<td>h.hatfield@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Hope</td>
								<td>Fuentes</td>
								<td>Secretary</td>
								<td>San Francisco</td>
								<td>41</td>
								<td>2010/02/12</td>
								<td>$109,850</td>
								<td>6318</td>
								<td>h.fuentes@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Vivian</td>
								<td>Harrell</td>
								<td>Financial Controller</td>
								<td>San Francisco</td>
								<td>62</td>
								<td>2009/02/14</td>
								<td>$452,500</td>
								<td>9422</td>
								<td>v.harrell@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Timothy</td>
								<td>Mooney</td>
								<td>Office Manager</td>
								<td>London</td>
								<td>37</td>
								<td>2008/12/11</td>
								<td>$136,200</td>
								<td>7580</td>
								<td>t.mooney@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Jackson</td>
								<td>Bradshaw</td>
								<td>Director</td>
								<td>New York</td>
								<td>65</td>
								<td>2008/09/26</td>
								<td>$645,750</td>
								<td>1042</td>
								<td>j.bradshaw@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Olivia</td>
								<td>Liang</td>
								<td>Support Engineer</td>
								<td>Singapore</td>
								<td>64</td>
								<td>2011/02/03</td>
								<td>$234,500</td>
								<td>2120</td>
								<td>o.liang@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Bruno</td>
								<td>Nash</td>
								<td>Software Engineer</td>
								<td>London</td>
								<td>38</td>
								<td>2011/05/03</td>
								<td>$163,500</td>
								<td>6222</td>
								<td>b.nash@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Sakura</td>
								<td>Yamamoto</td>
								<td>Support Engineer</td>
								<td>Tokyo</td>
								<td>37</td>
								<td>2009/08/19</td>
								<td>$139,575</td>
								<td>9383</td>
								<td>s.yamamoto@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Thor</td>
								<td>Walton</td>
								<td>Developer</td>
								<td>New York</td>
								<td>61</td>
								<td>2013/08/11</td>
								<td>$98,540</td>
								<td>8327</td>
								<td>t.walton@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Finn</td>
								<td>Camacho</td>
								<td>Support Engineer</td>
								<td>San Francisco</td>
								<td>47</td>
								<td>2009/07/07</td>
								<td>$87,500</td>
								<td>2927</td>
								<td>f.camacho@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Serge</td>
								<td>Baldwin</td>
								<td>Data Coordinator</td>
								<td>Singapore</td>
								<td>64</td>
								<td>2012/04/09</td>
								<td>$138,575</td>
								<td>8352</td>
								<td>s.baldwin@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Zenaida</td>
								<td>Frank</td>
								<td>Software Engineer</td>
								<td>New York</td>
								<td>63</td>
								<td>2010/01/04</td>
								<td>$125,250</td>
								<td>7439</td>
								<td>z.frank@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Zorita</td>
								<td>Serrano</td>
								<td>Software Engineer</td>
								<td>San Francisco</td>
								<td>56</td>
								<td>2012/06/01</td>
								<td>$115,000</td>
								<td>4389</td>
								<td>z.serrano@datatables.net</td>
							</tr>
							
							<tr>
								<td class="details-control"></td>
								<td>Jennifer</td>
								<td>Acosta</td>
								<td>Junior Javascript Developer</td>
								<td>Edinburgh</td>
								<td>43</td>
								<td>2013/02/01</td>
								<td>$75,650</td>
								<td>3431</td>
								<td>j.acosta@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Cara</td>
								<td>Stevens</td>
								<td>Sales Assistant</td>
								<td>New York</td>
								<td>46</td>
								<td>2011/12/06</td>
								<td>$145,600</td>
								<td>3990</td>
								<td>c.stevens@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Hermione</td>
								<td>Butler</td>
								<td>Regional Director</td>
								<td>London</td>
								<td>47</td>
								<td>2011/03/21</td>
								<td>$356,250</td>
								<td>1016</td>
								<td>h.butler@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Lael</td>
								<td>Greer</td>
								<td>Systems Administrator</td>
								<td>London</td>
								<td>21</td>
								<td>2009/02/27</td>
								<td>$103,500</td>
								<td>6733</td>
								<td>l.greer@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Jonas</td>
								<td>Alexander</td>
								<td>Developer</td>
								<td>San Francisco</td>
								<td>30</td>
								<td>2010/07/14</td>
								<td>$86,500</td>
								<td>8196</td>
								<td>j.alexander@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Shad</td>
								<td>Decker</td>
								<td>Regional Director</td>
								<td>Edinburgh</td>
								<td>51</td>
								<td>2008/11/13</td>
								<td>$183,000</td>
								<td>6373</td>
								<td>s.decker@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Michael</td>
								<td>Bruce</td>
								<td>Javascript Developer</td>
								<td>Singapore</td>
								<td>29</td>
								<td>2011/06/27</td>
								<td>$183,000</td>
								<td>5384</td>
								<td>m.bruce@datatables.net</td>
							</tr>

							<tr>
								<td class="details-control"></td>
								<td>Donna</td>
								<td>Snider</td>
								<td>Customer Support</td>
								<td>New York</td>
								<td>27</td>
								<td>2011/01/25</td>
								<td>$112,000</td>
								<td>4226</td>
								<td>d.snider@datatables.net</td>
							</tr>
						</tbody>
					</table>
				</div>
                
                
                </div>
                
              </div>

            </div>
          </div><!-- Javascript -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/simplebar/simplebar.min.js"></script>
    <script src='assets/plugins/data-tables/jquery.datatables.min.js'></script>
    <script src='assets/plugins/data-tables/datatables.bootstrap4.min.js'></script>

    

    <script src="assets/js/sleek.js"></script>
  <link href="assets/options/optionswitch.css" rel="stylesheet">
<script src="assets/options/optionswitcher.js"></script>    
          
          <script>
  /* Formatting function for row details - modify as you need */
  function format () {
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
			'<tr>'+
				'<td>Full name:</td>'+
				'<td>Name...</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extension number:</td>'+
				'<td>123</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extra info:</td>'+
				'<td>And any further details here (images etc)...</td>'+
			'</tr>'+
    '</table>';
  }
 
  $(document).ready(function() {
    var table = $('#expendable-data-table').DataTable( {
      "className":      'details-control',
      "order": [[0, 'asc']],
      "aLengthMenu": [[20, 30, 50, 75, -1], [20, 30, 50, 75, "All"]],
      "pageLength": 20,
      "dom": '<"row align-items-center justify-content-between top-information"lf>rt<"row align-items-center justify-content-between bottom-information"ip><"clear">'
    });

    // Add event listener for opening and closing details
    $('#expendable-data-table tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = table.row( tr );
 
      if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      }
      else {
        // Open this row
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
      }
    });
  });
</script>


@endsection