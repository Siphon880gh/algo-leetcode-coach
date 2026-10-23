## Tiny example

Drill with `a=[10,20,30]`.

1. Read `a[2]` → `30` in O(1)
2. Insert `5` at array head → shift all right → O(n) → `[5,10,20,30]`
3. Same insert at head of linked list `10→20→30` → rewire one pointer → O(1)

Feel the tradeoff: arrays win index reads; linked lists win local head inserts.


## How

1. Time an index read on an array
2. Time a head insert on an array (shifts)
3. Time a head insert on a linked list (pointer rewire)


## Trap

Assuming every “insert” is O(1) because linked-list inserts sometimes are.

**Fix:** Ask: insert where, and do you already hold a neighbor pointer?

**Time:** array index O(1); array head insert O(n); list head insert O(1)

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
