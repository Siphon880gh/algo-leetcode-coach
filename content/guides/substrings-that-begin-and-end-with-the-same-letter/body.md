Given a string s of lowercase letters, return the number of substrings that begin and end with the same character. Single characters count. For instance, abcba → 7, abacad → 9, and a → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Pairs of equal positions

`Σ c · (c + 1) / 2` over the counts `c` of each letter.

Constructed checks (verified against every substring on random strings): the three cases above → 7, 9, 1.

A substring is fixed by its first and last index; it qualifies when those letters match. Choosing two positions of the same letter (`c · (c − 1) / 2`) or one position alone (`c`) gives the formula. Use 64-bit for long strings.

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
