## Track the leftmost open stack

**State:** `stacks` (a list of lists) and `open`, a min-heap of indices with room.

- `push(val)`: drop heap entries `≥ len(stacks)` or for full stacks. If the heap is empty, append a new stack and use it; otherwise use the top index. Push `val`; if that stack still has room, keep its index in the heap.
- `popAtStack(i)`: if `i` is out of range or the stack is empty, return −1. Pop, and push `i` onto the heap (it now has room).
- `pop()`: remove empty stacks from the right end, then `popAtStack(last index)`, or −1 if none remain.

Do not scan for the leftmost open stack on each push; there can be 10⁵ stacks. Do not leave empty stacks at the end; `pop` must find the rightmost non-empty one quickly.

Time: O(log n) amortised per call  
Space: O(total plates)

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
