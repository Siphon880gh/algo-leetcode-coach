## Split the remaining nodes

`f(n)`:

- If `n` is even, return `[]`.
- If `n == 1`, return `[Node(0)]`.
- Otherwise, for each odd `i` from 1 to `n − 2`: for each `L` in `f(i)` and `R` in `f(n − 1 − i)`, add `Node(0, L, R)`.

Cache `f(n)` by `n`.

Sharing subtrees between results is fine; the trees are only read.

The number of trees grows like the Catalan numbers, so the output size dominates the cost.

Do not try even left sizes; they produce nothing. Do not rebuild `f(i)` for every split without the cache.

Time: proportional to the number of trees produced  
Space: the same, for the cached lists

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
