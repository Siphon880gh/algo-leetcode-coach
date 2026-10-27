## Add the run length

1. `run = 1` if `s[i] ≠ s[i − 1]`, else `run + 1`.
2. `ans = (ans + run) mod 1e9+7`.

`"abbcccaa"` → 1 + 1 + 2 + 1 + 2 + 3 + 1 + 2 = 13. `"xy"` → 2. `"zzzzz"` → 15.

A run of length L contributes L(L + 1)/2, which is what the per-position sum adds up to. Apply the modulo; a run of 10^5 gives about 5 · 10^9.

Time: O(n)  
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
