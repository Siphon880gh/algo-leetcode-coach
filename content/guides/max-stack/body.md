Design a stack that supports `push(x)`, `pop()`, `top()`, `peekMax()` (the largest value), and `popMax()` (remove and return the largest value; if there are several, remove the one closest to the top). _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two views of the same nodes

- A **doubly linked list** with sentinels holds the stack order; the tail is the top.
- A **sorted map** `value → list of nodes` (pushed in order) finds the maximum.

Operations:

- `push(x)`: append a node at the tail, and append it to `map[x]`.
- `pop()`: unlink the tail node, and pop it from the end of `map[val]` (it is the newest of that value). Remove the key if the list is empty.
- `top()`: the tail's value.
- `peekMax()`: the largest key.
- `popMax()`: take the largest key, pop its newest node from the map list, and unlink that node from the linked list.

**Lazy alternative:** a stack and a max-heap of `(−value, −id)`, plus a set of removed ids. `pop` and `popMax` mark ids as removed; `top` and `peekMax` discard removed entries first. That is amortized O(log n).

The simple two-stack version (a second stack of running maxima) has an O(n) `popMax`: pop into a buffer until reaching the max, then push the buffer back.

Do not remove the oldest copy of the max; the one nearest the top must go.

Time: O(log n) per operation  
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
