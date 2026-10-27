## Prefix remainders

1. Count pairs of equal prefix sums mod k (start with remainder 0 seen once).
2. For each run of value v with length c: for L = 1 … c with L · v divisible by k, subtract c − L (the extra copies).
3. Return the result.

Examples → 3, 2. Checked against a set of every good subarray on 3,000 random arrays.

Not removing repeats: example 2 → 5 instead of 2.

Time: O(n)  
Space: O(min(n, k))

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
