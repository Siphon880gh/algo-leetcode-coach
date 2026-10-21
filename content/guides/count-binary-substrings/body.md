## Runs, not substrings

A valid substring is some 0s followed by the same number of 1s, or the reverse, so it straddles the border between two neighboring runs.

With run lengths `a` (left) and `b` (right), the valid substrings centered on that border have lengths `2, 4, …, 2 · min(a, b)`, which is `min(a, b)` of them.

Keep only `prev` and `cur` run lengths. On a character change, add `min(prev, cur)`, then `prev = cur`, `cur = 1`. Add the final pair at the end.

Example: `"00110011"` has runs `2,2,2,2` → `2 + 2 + 2 = 6`.

Do not enumerate substrings; that is O(n²) or worse. Do not count substrings like `"0101"`; the 0s and 1s must each be grouped together.

Time: O(n)  
Space: O(1)

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
