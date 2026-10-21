## A small wall encloses a small area

`limit = len(blocked) · (len(blocked) − 1) // 2`: the most cells `b` blocks can cut off (a diagonal across a corner).

`free(a, b)`: BFS from `a` over 4-neighbours inside the 10⁶ × 10⁶ grid, skipping blocked cells (store them in a set). Return true if it reaches `b` or visits more than `limit` cells; false if the queue empties first.

Answer: `free(source, target) and free(target, source)`.

Run both directions: the target may be the one trapped. Do not BFS the whole grid; it has 10¹² cells. Do not use a 2-D array for visited; use a hash set.

Time: O(B²)  
Space: O(B²)

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
