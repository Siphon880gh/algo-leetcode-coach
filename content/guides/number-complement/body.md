## Mask as wide as num

Let `L` be the number of bits in `num` (position of the highest set bit + 1). `mask = (1 << L) − 1` is `L` ones. Then `num ^ mask` flips exactly those `L` bits. For 5: `L = 3`, `mask = 111`, `101 ^ 111 = 010`.

To build the mask without a bit-length helper: start `mask = 0`; while `mask < num`, set `mask = (mask << 1) | 1`. Use a 64-bit shift if `L` can be 31, so `1 << 31` does not overflow.

Complement of Base 10 Integer (1009) is the same problem but allows `0` (whose complement is 1). Number of 1 Bits (191) and Hamming Distance (461) are other bit-count exercises.

Do not return `~num` — in a 32-bit int it also flips all the leading zeros and gives a negative number. Do not convert to a string and back unless you must.

Time: O(1)  
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
