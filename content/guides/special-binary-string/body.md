## Think of parentheses

Read `1` as `(` and `0` as `)`. A special string is a balanced sequence, and a swap of two adjacent special substrings is a swap of two adjacent balanced blocks.

`best(s)`:

1. Split `s` into top-level blocks: scan with a balance counter and cut whenever it returns to 0.
2. Each block is `1 + inner + 0`; replace it with `"1" + best(inner) + "0"`.
3. Sort the blocks in descending lexicographic order and concatenate.

Adjacent swaps allow any permutation of sibling blocks, so sorting them is reachable; recursing makes each block's inside as large as possible first.

Do not swap characters directly; only whole special substrings may move. Do not sort without recursing; inner blocks can improve too.

Time: O(n²) for the slicing and sorting at each level  
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
