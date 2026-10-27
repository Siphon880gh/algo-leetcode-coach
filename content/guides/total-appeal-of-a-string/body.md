## Contribution counting

1. `last[c] = −1` for all letters.
2. For each `i`: `ans += (i − last[s[i]]) · (n − i)`; `last[s[i]] = i`.

Examples → 28, 20. Checked against counting distinct letters of every substring on 200 random strings.

Each substring’s appeal counts every distinct letter once, so crediting the leftmost copy of each letter counts it exactly once. Even a string of one repeated letter totals about 5 · 10^9 for n = 10^5, and all 26 letters cycling give about 1.3 · 10^11, so use 64-bit.

Time: O(n)  
Space: O(26)

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
