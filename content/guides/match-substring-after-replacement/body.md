## Every alignment

1. `M` = set of `(old, new)` pairs.
2. For each start `i` with `i + |sub| ≤ |s|`: if for all `j`, `sub[j] = s[i + j]` or `(sub[j], s[i + j]) ∈ M`, return true.
3. Return false.

Examples → true, false, true.

Each character of sub is replaced at most once, and replacing it once with the character it must match is all that alignment needs, so the per-position test is exact. A mapping is one-way: [o, 0] lets o become 0, never 0 become o, which is why Example 2 fails. With |s| ≤ 5000 the O(|s| · |sub|) scan is fine.

Time: O(|s| · |sub| + |mappings|)  
Space: O(|mappings|), or a 62 × 62 table

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
