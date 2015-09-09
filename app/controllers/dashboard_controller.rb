class DashboardController < ApplicationController
  def index
   if !logged_in?
    redirect_to :controller => "sessions" , :action => "new"    
    end
  end

end
