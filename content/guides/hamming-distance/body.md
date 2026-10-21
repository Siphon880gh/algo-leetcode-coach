## XOR marks the differences

`z = x ^ y` has a 1 bit exactly where `x` and `y` disagree. Count the 1 bits of `z`:

- Brian Kernighan: while `z`, do `z &= z − 1` (drops the lowest set bit) and add 1. Runs once per set bit.
- Or use a built-in popcount (`bit_count()`, `Integer.bitCount`, `__builtin_popcount`).

Minimum Bit Flips to Convert Number (2220) is the same problem. Total Hamming Distance (477) sums this over every pair — count ones per bit position instead of looping pairs. Number of 1 Bits (191) is the popcount step alone.

Do not compare decimal digits. Do not loop 32 times on a shifting negative number in languages with arithmetic shift — the inputs here are non-negative, so it is safe, but prefer `z & (z − 1)`.

Time: O(1) (at most 31 bits)  
Space: O(1)

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
