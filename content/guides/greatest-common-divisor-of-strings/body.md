## Commuting strings share a root

1. If `str1 + str2 != str2 + str1`, return `""`.
2. Return `str1[:gcd(len(str1), len(str2))]`.

If both strings are repeats of some `x`, either order of concatenation gives the same string. Conversely, equal concatenations force a common root, and the longest divisor has length equal to the gcd of the lengths.

Do not try every prefix length and test both strings; it works but is slower and easy to get wrong. Do not return the shorter string just because it is a prefix; `"ABAB"` and `"ABABAB"` share `"AB"`, not `"ABAB"`.

Time: O(m + n)  
Space: O(m + n)

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
