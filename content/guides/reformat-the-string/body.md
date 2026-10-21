## Alternate the groups

1. `L` = letters, `D` = digits.
2. If `|len(L) − len(D)| > 1`, return `""`.
3. Let `A` be the longer group (either if equal); interleave `A[0], B[0], A[1], …`.

`"a0b1c2"` → `"0a1b2c"` (any valid answer). `"leetcode"` → `""`. `"1229857369"` → `""`.

Do not start with the shorter group when lengths differ; it would run out. Do not try permutations; counts decide.

Time: O(n)  
Space: O(n)

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
