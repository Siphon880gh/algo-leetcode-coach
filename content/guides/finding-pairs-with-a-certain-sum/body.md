## Counter on nums2

1. `cnt = Counter(nums2)`.
2. `add(i, v)`: `cnt[nums2[i]] −= 1`; `nums2[i] += v`; `cnt[nums2[i]] += 1`.
3. `count(tot)`: `Σ cnt[tot − x]` over `x` in `nums1`.

Example → `8, 2, 1, 11`.

Hash the larger array and iterate the smaller one; the reverse would cost up to 10^5 per count. Remember to decrement the old value in `add`.

Time: O(1) add, O(|nums1|) count  
Space: O(|nums2|)

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
