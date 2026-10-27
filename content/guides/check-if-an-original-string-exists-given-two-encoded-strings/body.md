## State (i, j, diff)

1. Done when `i` and `j` reach the ends with `diff == 0`.
2. Digits at `s1[i]`: for each prefix of the digit run (1, 2 or 3 digits) with value `v`, recurse with `diff + v`. Same for `s2[j]` with `diff − v`.
3. `diff > 0`: `s2[j]` must be a letter, consumed by a pending wildcard: `(i, j + 1, diff − 1)`.
4. `diff < 0`: symmetric on `s1`.
5. `diff == 0`: both letters and equal → `(i + 1, j + 1, 0)`.

Examples → true, true, false.

Digit runs are at most 3 long and strings at most 40 characters, so `diff` stays within a few thousand and the memo stays small. Trying every split of a digit run is what lets "123" mean 1 + 23, 12 + 3, 123, and so on.

Time: O(n · m · D) with D the range of diff  
Space: O(n · m · D)

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
