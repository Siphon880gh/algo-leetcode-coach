## Example first

nums = [2, 4, 6, 3], k = 2. Remainders 0, 0, 0, 1.

1. The run [2, 4, 6] has r = 0, so (L − 1) · 0 ≡ 0 for every length. Length 3 works.
2. [3] alone works too, but it is shorter.

Answer 3.

## Rule

Deleting any element must leave a multiple of k, so every element matches the sum mod k. All elements share a remainder r, and the length L must satisfy (L − 1) · r ≡ 0 (mod k).

## Steps

1. Walk nums, reducing each value mod k.
2. Extend the run while the remainder repeats; otherwise start a new run with cnt = 1.
3. When (cnt − 1) · r mod k = 0, update the answer with cnt.

r and cnt can both reach 10^5, so the product can reach 10^10. Compute it in 64 bits.

## Trap

Computing (cnt − 1) · r in 32 bits. Near 10^10 it overflows and the divisibility test turns random. Fix: use 64-bit integers.

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
