Design a queue built from n that starts as [1, 2, …, n] and supports fetch(k): move the k-th element (1-indexed) to the end of the queue and return it. A follow-up typically asks for better than O(n) per call. For instance, with n = 8, fetch(3) → 3, fetch(5) → 6, fetch(2) → 2, fetch(8) → 2. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Live-slot counting

1. Slots `1 … n + calls`; slots `1 … n` hold `1 … n` with count 1.
2. `fetch(k)`: find the smallest slot whose prefix count is `k` (Fenwick binary lifting).
3. Set that slot to 0, write the value to slot `size + 1`, set it to 1, return the value.

Constructed check (verified against a list simulation): `n = 8`, fetch 3, 5, 2, 8 → 3, 6, 2, 2; the queue ends as `[1,4,5,7,8,3,6,2]`.

A plain list is O(n) per call, which is fine for small limits; √n buckets give O(√n). Size the tree for the maximum number of calls the statement allows.

Time: O(log(n + calls)) per fetch  
Space: O(n + calls)

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
