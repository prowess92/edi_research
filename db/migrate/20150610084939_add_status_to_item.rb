class AddStatusToItem < ActiveRecord::Migration
  def change
    add_column :items, :status, :boolean
  end
end
