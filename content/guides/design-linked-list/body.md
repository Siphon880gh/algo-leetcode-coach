## Walk to the predecessor

Keep `dummy` (its `next` is the head) and `size`.

- `get(i)`: if `i ≥ size`, return `-1`; otherwise walk `i + 1` steps from `dummy`.
- `addAtIndex(i, v)`: if `i > size`, do nothing. Otherwise walk `i` steps from `dummy` to the predecessor `p`, then `node.next = p.next`, `p.next = node`, `size += 1`.
- `addAtHead(v)` = `addAtIndex(0, v)`. `addAtTail(v)` = `addAtIndex(size, v)`.
- `deleteAtIndex(i)`: if `i ≥ size`, do nothing. Otherwise walk to the predecessor, set `p.next = p.next.next`, and `size −= 1`.

The sentinel removes every special case for the head. A doubly linked list with head and tail sentinels can walk from the nearer end, halving the average walk.

Do not allow `addAtIndex(size, v)` to be rejected; inserting at `size` appends. Do not forget to update `size`; every bounds check depends on it.

Time: O(i) per operation  
Space: O(n)

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
