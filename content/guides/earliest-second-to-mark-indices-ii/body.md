## Check t

1. first[i] = first second where changeIndices is i.
2. ok(t): cnt = 0, heap = empty. For s = t down to 1, with i = changeIndices[s]:
   - if nums[i] = 0 or s ≠ first[i]: cnt += 1;
   - else push nums[i]; if cnt > 0, cnt −= 1 (a later second marks it); else pop the smallest and cnt += 1.
3. Indices not in the heap need nums[i] decrements and one mark each: ok if cnt ≥ Σ nums − Σ heap + (n − |heap|).
4. Binary-search the smallest t with ok(t), or −1.

Examples → 6, 7, −1. Checked against a search over every choice per second on 700 random small cases.

Without the heap swap (keep the first zeroings, skip later ones) the check is too strict: nums = [1, 3, 1] with changeIndices [1, 1, 1, 2, 3, 3, 1, 3] → 7 instead of 6.

Time: O(m log n · log m)  
Space: O(n)

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
