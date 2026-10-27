## Best on each side of a cut

1. Manacher (odd): `d[i]` = radius count, palindrome length `2d[i] − 1`.
2. `pre[i + d[i] − 1] = max(…, 2d[i] − 1)`; sweep right-to-left with `pre[i] = max(pre[i], pre[i + 1] − 2)` (trim both ends), then left-to-right running max.
3. Mirror for `suf` from the starting index.
4. Return `max(pre[i] · suf[i + 1])`.

`"ababbb"` → 9. `"zaaaxbbby"` → 9. Checked against brute force on random strings.

The −2 step matters: a palindrome ending at `e` contains a shorter one ending at `e − 1` (dropping one char from each end). Without it, `pre` misses shorter palindromes that end earlier.

Time: O(n)  
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
