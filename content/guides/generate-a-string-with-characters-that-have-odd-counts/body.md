## Parity

1. `n` odd → `"a" · n`.
2. `n` even → `"a" · (n − 1) + "b"`.

`n = 4` → `"aaab"` (the statement's `"pppz"` is also valid). `n = 2` → `"ab"`. `n = 7` → `"aaaaaaa"`.

Do not split an even `n` into two equal halves; that works only when `n / 2` is odd (for `n = 4`, two counts of 2 are even). Any valid string is accepted.

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
