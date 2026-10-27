## Compare each bit with its neighbor

`x = n ^ (n >> 1)` has a 1 wherever a bit differs from the bit above it. If the bits alternate, every position up to the top bit differs, so `x` is a solid block of ones like `0b111…1`.

A solid block of ones plus 1 is a power of two, so `x & (x + 1) == 0` tests it.

Example: `5 = 101`, `5 >> 1 = 010`, XOR is `111` → true. `7 = 111`, `7 >> 1 = 011`, XOR is `100` → false.

A plain loop also works: compare `n & 1` with the previous bit while shifting right.

Do not compare against hard-coded patterns like `0x55555555`; the alternation can start at either bit.

Time: O(1)  
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
