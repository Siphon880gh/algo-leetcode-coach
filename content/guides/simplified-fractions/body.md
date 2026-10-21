## Lowest terms only

1. For `b` in 2..n, for `a` in 1..b−1: if `gcd(a, b) == 1`, add `"a/b"`.

n = 2 → `["1/2"]`. n = 3 → `["1/2","1/3","2/3"]`. n = 4 → adds `"1/4"`, `"3/4"` (not `"2/4"`).

Do not deduplicate by float value; gcd is exact. Any output order is accepted.

Time: O(n² log n)  
Space: O(n²) output

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
