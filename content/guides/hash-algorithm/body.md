## Tiny example

You want to put string keys into a table with 8 buckets.

A naive hash such as `hash("cat") = the sum of the character codes` can bunch similar words together. A better hash mixes the bits thoroughly, so `"cat"` and `"cats"` land far apart. This is called the avalanche effect.

The goal: after taking `% capacity`, different keys should look **evenly spread** across the buckets `0` to `capacity − 1`.

## How

1. Turn the key into an integer, using the language's hash or your own.
2. Fold that integer into a bucket index, with `% capacity`, or with a bit mask when the capacity is a power of two.
3. Judge the hash by its collision rate and load factor, not by whether it feels random.

## Trap

Using only the low digits or bits of a key, such as `key % 100` when every key is a multiple of 100. Then every key collides.

**Fix:** Mix in the high bits too, and test with realistic keys.

**Time:** O(1) to compute a typical hash · **Space:** O(1)

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
