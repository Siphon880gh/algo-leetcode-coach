## Kadane

1. `val[c]` = alphabet position; overwrite with `vals[i]` for `chars[i]`.
2. `cur = best = 0`. For each character: `cur = max(cur, 0) + val[c]`; `best = max(best, cur)`.
3. Return `best`.

Examples → 2, 0. Checked against every substring on 300 random strings.

Starting best at 0 covers the empty substring when every value is negative.

Time: O(n)  
Space: O(1) (26 values)

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
