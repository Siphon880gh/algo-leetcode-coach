## Pairwise subset checks

1. `S[i] = set(favoriteCompanies[i])`.
2. Keep `i` if, for all `j ≠ i`, `S[i]` is not a subset of `S[j]` (skip when `len(S[j]) < len(S[i])`).
3. Return the indices in increasing order.

`[["leetcode","google","facebook"],["google","microsoft"],["google","facebook"],["google"],["amazon"]]` → `[0,1,4]`.

Lists are distinct, so equal sets do not occur. Do not compare lists as sequences; order does not matter. Map names to ints or bitsets for speed.

Time: O(n² · m)  
Space: O(n · m)

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
