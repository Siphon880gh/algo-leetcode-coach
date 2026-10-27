## Inner round boundaries

1. `a`, `b` = minutes since midnight; if `b < a`, `b += 1440`.
2. Return `max(0, b // 15 − ceil(a / 15))`.

`"09:31", "10:14"` → 1. `"21:30", "03:00"` → 22. `"00:01", "00:14"` → 0. Checked against counting rounds directly on random time pairs.

The clamp matters when both times fall inside one round: the formula gives −1 there. Rounding login up and logout down keeps only rounds played in full.

Time: O(1)  
Space: O(1)

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
