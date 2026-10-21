## Scan from the right

For `i` from `n − 1` down to 0: if `num[i]` is odd, return `num[:i + 1]`. Return `""`.

`"52"` → `"5"`. `"4206"` → `""`. `"35427"` → `"35427"`.

Any odd substring ends at an odd digit; the prefix ending at the last one is the longest such string and, with no leading zeros, the largest. Never convert to an integer: the string has up to 10^5 digits.

Time: O(n)  
Space: O(1) besides the output

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
