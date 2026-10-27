## Example first

nums = [3, 1, 3, 2, 1, 3]. Counts: 1 → 2 copies, 2 → 1 copy, 3 → 3 copies.

| Round | Appended | Copies left |
|-------|----------|-------------|
| 1 | 1, 2, 3 | 1: 1, 3: 2 |
| 2 | 1, 3 | 3: 1 |
| 3 | 3 | none |

Answer [1, 2, 3, 1, 3, 3].

## Steps

1. Count each value.
2. While the output is shorter than n, scan values from 1 up to the maximum and append each value whose count is still positive, decrementing it.
3. Return the output.

## Trap

Just sorting. Example 1 then gives [1, 1, 2, 3, 3, 3] instead of [1, 2, 3, 1, 3, 3]. Fix: each round takes only one copy of each value.

Checked: the examples match, and the counting matched deleting from the array round by round on 300 random arrays.

Time: O(n · m) with m ≤ 100 the largest value  
Space: O(m)

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
