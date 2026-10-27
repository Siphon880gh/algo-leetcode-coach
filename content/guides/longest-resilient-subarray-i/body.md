## Example first

nums = [1, 4, 7, 1], k = 3. The sum is 13. Deleting each element leaves 12, 9, 6 and 12, all divisible by 3. Answer 4.

All four remainders are 1, and (4 − 1) · 1 = 3 is divisible by 3.

## Rule

1. sum − a_i ≡ 0 (mod k) for every i means every a_i ≡ sum (mod k). So all elements share one remainder r.
2. Then sum ≡ L · r, so the rule becomes L · r ≡ r, which is (L − 1) · r ≡ 0 (mod k).
3. Length 1 always works.

## Steps

1. Walk nums and track the current run of equal remainders and its length cnt.
2. When (cnt − 1) · r mod k = 0, update the answer with cnt.
3. Any length inside a run is reached as cnt grows, so this checks every candidate.

## Trap

Requiring every element to be a multiple of k. Example 2 has remainders 1, 1, 1, 1 and is valid, so that test gives 1 instead of 4. Fix: equal remainders plus the length rule.

Checked: the examples give 3, 4 and 2, and the scan matched checking every subarray on 300 random arrays.

Time: O(n)  
Space: O(1)

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
