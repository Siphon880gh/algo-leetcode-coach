## Tiny example

The problem: for each index `i`, is there an earlier index `j` with `nums[j] == target - nums[i]`? This is the Two Sum pattern.

With nested loops, you check every earlier index for every `i`, which is O(n²).

With a hash set or map, scan from left to right. At each `i`, look up `need = target - nums[i]` in expected O(1) time, then add `nums[i]`.

You spend **O(n) memory** to remove the inner scan for every index.

## How

1. Notice a repeated question such as "have I seen X before?" or "where did X last appear?".
2. Create a hash set or hash map.
3. Replace the inner scan with a lookup, and update the map as you go.

## Trap

Using objects as keys without a proper equality and hash method, then wondering why lookups miss.

**Fix:** Define equality consistently with the hash, and prefer keys that cannot change.

**Time:** expected O(n) for one scan with a map · **Space:** O(n)

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
