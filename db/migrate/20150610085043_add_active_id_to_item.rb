class AddActiveIdToItem < ActiveRecord::Migration
  def change
    add_column :items, :active_id, :decimal
  end
end
