## The answer sits at the boundary

Order: higher score first, then smaller name.

1. `top`: the locations ranked better than the current query position, with the worst on top.
2. `rest`: everything else, with the best on top.
3. `add(name, score)`: push into `top`, then pop the worst of `top` into `rest`.
4. `get()`: pop the best of `rest`, push it into `top`, return its name.

Example → `[null,null,null,branford,null,alps,null,bradford,null,bradford,null,bradford,orland]`. Checked against sorting all locations on every get for random operation sequences.

`top` always holds exactly the number of gets so far, so the best of `rest` is the i-th best overall. Each operation is O(log n). In languages without custom comparators, store the score negated and compare names in reverse for the worst-first heap.

Time: O(log n) per call  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
