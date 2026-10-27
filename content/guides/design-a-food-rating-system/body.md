## Lazy heaps

1. `rating[food]`, `cuisine[food]`; `h[c]` holds `(−rating, name)`.
2. `changeRating(f, r)`: `rating[f] = r`; push `(−r, f)` onto `h[cuisine[f]]`.
3. `highestRated(c)`: pop while the top’s rating differs from `rating[name]`; return the top name.

Example → null, kimchi, ramen, null, sushi, null, ramen.

Ties go to the lexicographically smaller name, which the tuple order gives, as in the last call. A sorted set per cuisine with real removal also works.

Time: O(log n) amortised per call  
Space: O(n + calls)

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
