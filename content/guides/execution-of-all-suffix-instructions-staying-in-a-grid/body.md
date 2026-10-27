## One walk per suffix

For each `i`: position = `startPos`; for `s[i …]`: move; if outside, stop; else count. Record the count.

Examples → `[1,5,4,3,1,0]`, `[4,1,0,0]`, `[0,0,0,0]`.

Each walk restarts at `startPos`, not where the previous one ended. At most 500 · 500 moves, so no cleverness is needed; an O(m) method exists using offsets from the end, but it is far more intricate.

Time: O(m²)  
Space: O(m)

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
