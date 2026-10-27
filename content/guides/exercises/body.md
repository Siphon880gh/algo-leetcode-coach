## Tiny example

Practice with `a = [10, 20, 30]`.

1. Reading `a[2]` gives `30` in O(1).
2. Inserting `5` at the front of the array shifts every element right, giving `[5, 10, 20, 30]`. That is O(n).
3. Inserting `5` at the front of the linked list `10→20→30` only needs the new node to point at the old head. That is O(1).

The tradeoff: arrays win at reading by index, and linked lists win at inserting next to a node you already hold.

## How

1. Time an index read on an array.
2. Time an insert at the front of an array, which shifts everything.
3. Time an insert at the front of a linked list, which only rewires a pointer.

## Trap

Assuming every insert is O(1) because some linked-list inserts are.

**Fix:** Ask where the insert happens, and whether you already hold a pointer to the neighboring node.

**Time:** array index read O(1); array insert at the front O(n); linked-list insert at the head O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
