## Explore every reachable string

1. Queue `[s]`, `seen = {s}`.
2. From `x`: add `a` to odd indices (mod 10), and rotate right by `b`; push unseen results.
3. Return the minimum over `seen`.

`"5525"`, 9, 2 → `"2050"`. `"74"`, 5, 1 → `"24"`. `"0011"`, 4, 2 → `"0011"`.

At most `n · 100` states (rotation offsets × two digit offsets), so BFS is cheap. A smarter enumeration loops rotations and add counts directly. Do not stop BFS at the first decrease.

Time: O(n² · 100)  
Space: O(n² · 100)

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
