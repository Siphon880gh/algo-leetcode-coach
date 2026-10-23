## Tiny example

Make change for `36` with coins `[25, 10, 5, 1]` (US-like).

Greedy plan: always take the largest coin that fits.

1. Take one `25` → remain `11`
2. Take one `10` → remain `1`
3. Take one `1` → remain `0`

Total 3 coins. Here the greedy choice works.

## When greedy is safe

You need a proof (exchange argument / greedy stays ahead) or a known safe pattern (interval scheduling by end time, Huffman, etc.). **Counterexample coins** like `[1, 3, 4]` for amount `6`: greedy `4+1+1` uses 3 coins, but `3+3` uses 2.

## How to try it

1. Sort or order candidates by the greedy key
2. Commit to the next locally best choice that stays feasible
3. Never revise earlier picks (that would be backtracking/DP)

## Trap

Assuming “locally best” is globally best because it worked on one sample.

**Fix:** Find a tiny counterexample, or cite the pattern’s proof. If you cannot, use DP/backtracking.

**Time:** often O(n log n) from sorting, then O(n)  
**Space:** O(1) extra beyond the input order

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
