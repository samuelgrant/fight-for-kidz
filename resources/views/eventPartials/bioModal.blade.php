<!-- Dynamic bio modal -->
<div id="bio-modal" class="modal fade pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:4005;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body contender-modal-body pl-0">
                {{-- Dynamic content will load here --}}
                <div class="dynamic-content" style="color:black;">
                    <div class="text-center text-white">
                        <h3 id=first-name class="d-inline mx-2"></h3>
                        <h2 id="nickname" class="d-inline"></h2>
                        <h3 id="last-name" class="d-inline mx-2"></h3>
                        <iframe class="iframe-video" id="bio-vid" src="" frameborder="0" allow="autoplay; encrypted-media;" allowfullscreen style="border-bottom: 1px solid white; border-top: 1px solid white;"></iframe>

                        {{-- Sponsor logo --}}
                        <div id="bio-sponsor-div" class="col-lg-6 pt-2 mx-auto text-center d-none">
                            <label for="bio-sponsor" style="width:100%;">Sponsored by...</label>
                            <a id="sponsorLink" target="blank">
                                <img id="bio-sponsor" class="img-fluid" style="max-height: 100px;">
                            </a>  
                        </div>

                        <div class=" px-4 py-3 text-white text-justify">
                            <h3 class="bio-label"></h3>
                            <p id="bio-text"></p>
                        </div>

                        <div class="row pl-3">
                            <div class="col-lg-4">
                                <img id="bio-image" class="img-fluid mb-2">
                            </div>
                            
                            <div class="col-lg-6">
                                <h5 class="text-center text-white">My Stats:</h5>
                                <table id="contenderTable" class="table table-sm text-center">
                                    <tbody>
                                        <tr>
                                            <td>Age: <span id="contenderAge"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Weight (kg): <span id="contenderWeight"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Height (cm): <span id="contenderHeight"></span></td>
                                        </tr>
                                        <tr>
                                            <td>Reach (cm): <span id="contenderReach"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
                <div class="modal-footer contender-modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div><!-- close bio-modal -->