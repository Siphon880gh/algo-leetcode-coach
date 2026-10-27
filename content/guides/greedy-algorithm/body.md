## Tiny example

Make change for `36` using the coins `[25, 10, 5, 1]`, like US coins.

The greedy plan is to always take the largest coin that still fits.

1. Take one `25`. That leaves `11`.
2. Take one `10`. That leaves `1`.
3. Take one `1`. That leaves `0`.

That is 3 coins, and here the greedy choice is the best possible.

## When greedy is safe

You need a proof, such as an exchange argument or a "greedy stays ahead" argument, or a pattern already known to be safe, such as interval scheduling by earliest end time or Huffman coding.

Here is a **counterexample**: with coins `[1, 3, 4]` and amount `6`, greedy takes `4 + 1 + 1`, which is 3 coins. But `3 + 3` uses only 2.

## How to try it

1. Order the candidates by the greedy key, often by sorting.
2. Commit to the next locally best choice that keeps the answer valid.
3. Never go back and change an earlier pick. Going back would be backtracking or dynamic programming.

## Trap

Assuming the locally best choice is best overall because it worked on one sample.

**Fix:** Look for a tiny counterexample, or point to the proof for the pattern. If you cannot do either, use dynamic programming or backtracking.

**Time:** often O(n log n) to sort, then O(n)  
**Space:** O(1) beyond the sorted input

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
