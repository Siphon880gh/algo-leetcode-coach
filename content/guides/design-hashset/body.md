## Bucket by key mod a prime

Pick a bucket count such as 769 or 10007 (a prime spreads keys better). `h(key) = key % B`.

- `add`: if `key` is not in `bucket[h]`, append it.
- `remove`: delete it from `bucket[h]` if present.
- `contains`: check `bucket[h]`.

With at most 10⁴ calls, buckets stay short. A production set would resize when the load factor gets too high.

Because keys are limited to `0 … 10⁶`, a boolean array of size `10⁶ + 1` (or a bitset) is a valid O(1) answer, and it is good to mention as the trade-off: more memory, no hashing.

Do not use the language's built-in set; that defeats the exercise. Do not append duplicates on `add`, or `remove` will leave a copy behind.

Time: O(1) average  
Space: O(B + n)

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
