## Intersection of top-left rectangles

Each operation `[a, b]` adds 1 to every cell with `x < a` and `y < b`. All of these rectangles share the corner `(0, 0)`, so their intersection is the rectangle `min(a) × min(b)`. Those cells receive every increment, and every other cell misses at least one.

Start with `x = m`, `y = n`; for each operation, `x = min(x, a)` and `y = min(y, b)`. Return `x · y`. With no operations, every cell is 0, so all `m · n` cells are tied for the max.

Do not build the matrix; `m` and `n` go up to 4 · 10⁴. Do not return the max value itself; the question asks how many cells hold it.

Time: O(k) for k operations  
Space: O(1)

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
