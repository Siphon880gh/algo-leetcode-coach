## Masks and disjoint unions

1. For each string, build its mask; skip it if a letter repeats.
2. `go(i, cur)`: update `best` with `popcount(cur)`; for `j ≥ i`, if `cur & mask[j] == 0`, call `go(j + 1, cur | mask[j])`.
3. Return `best`.

`["un","iq","ue"]` → 4. `["cha","r","act","ers"]` → 6.

With at most 16 strings there are at most 2¹⁶ subsets.

Do not keep strings with repeated letters; they can never be used. Do not compare strings character by character; mask AND is O(1).

Time: O(2ⁿ)  
Space: O(n) recursion

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
